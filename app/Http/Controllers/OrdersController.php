<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\User;
use App\Models\File;
use App\Models\Invoice;
use App\Models\InvoiceList;
use App\Events\OrderUpdate;

class OrdersController extends Controller
{
    public function index(){
        $orders = Order::latest()->paginate(10);
        return view("orders")->with("orders", $orders);
    }

    public function show(Order $order){
        $writers = User::where('role', 'writer')->get();
        $files = File::where('order_id', $order->id)->get();
        $currentWriter = User::find($order->writer_id);
        return view("order")->with("order", $order)->with("writers", $writers)->with("assignedWriter", $currentWriter)->with('files', $files);
    }

    public function add(Request $request){
        $order = new Order;
        $order->title = $request->topic;
        $order->pages = $request->pages;
        $order->sources = $request->sources;
        $order->format = $request->format;
        $order->spacing = $request->spacing;
        $order->files = null;
        $order->deadline = \Carbon\Carbon::parse($request->date_deadline . '' . $request->time_deadline);
        $order->instructions = $request->instructions;
        $order->admin_id = $request->user()->id;

        $order->save();
        return redirect()->route('order.show', $order);
    }

    // order functions
    public function assign(Request $request, Order $order){
        // should have an event to send an email on this status change
        $order->status = "processing";
        $order->writer_id = $request->writer;
        $order->update();

        event(new OrderUpdate($order));
        return redirect()->back();
    }

    public function approve(Order $order){
        $order->status = "approved";
        $order->update();
        event(new OrderUpdate($order));
        return redirect()->back();
    }
    
    public function revision(Order $order){
        // should have an event to send an email on this status change
        $order->status = "revision";
        $order->update();
        event(new OrderUpdate($order));
        return redirect()->back();
    }

    public function dispute(Order $order){
        // should have an event to send an email on this status change
        $order->status = "diputed";
        $order->cpp = "0";
        $order->update();
        event(new OrderUpdate($order));
        return redirect()->back();
    }

    public function finish(Order $order){
        $order->status = "finished";
        $order->update();

        $amount = $order->cpp * $order->pages;

        $not_paid = 'not paid';

        // check if an invoice already exists
        // if it exists, update it, else, create a new one
        $invoice = Invoice::where('writer_id', $order->writer_id)->where('status', $not_paid)->first();
        if($invoice === null){
            $tempInvoice = Invoice::create([
                'total' => $amount,
                'statis' => $not_paid,
                'orders' => 1,
                'writer_id' => $order->writer_id
            ]);

            $this->createInvoiceList($order, $amount, $tempInvoice);
            return redirect()->back();
        }else{
            
            $invoice->orders = $invoice->orders + 1;
            $invoice->total = $invoice->total + $amount;
            $this->createInvoiceList($order, $amount, $invoice);
            $invoice->update();
        }
        
        return redirect()->back();
    }

    protected function createInvoiceList(Order $order, $amount, $invoice){
        return InvoiceList::create([
            'order_id' => $order->id,
            'writer_id' => $order->writer_id,
            'amount' => $amount,
            'pay_status' => 'not paid',
            'invoice_id' => $invoice->id
        ]);
    }

    public function reassign(Order $order){
        // should have an event to send an email on this status change
        $order->status = "available";
        event(new OrderUpdate($order));
        $order->writer_id = null;
        $order->update();
        return redirect()->back();
    }
    public function download(File $file){
        return response()->download($file->url);        
    }

    public function uploadFiles(Request $request, Order $order){
        // should have an event to send an email on this status change
        $files = array();
        if($request->hasFile('files')){
            foreach ($request->file('files') as $file) {

                $name = $file->getClientOriginalName();
                $ext = $file->extension();
                $onlyName = explode('.'.$ext,$name)[0];
                $mime = $file->getMimeType();
                $size = $file->getSize();
                $filename = $onlyName . '_' . time().rand(1,100) .'.' . $ext;
                $file->move(public_path('files'), $filename);  
                $files[] = $filename;  
                
                
                $order->files()->create(
                    [
                        'name' => $filename,
                        'mime' => $mime,
                        'size' => $size,
                        'uploaded_by' => $request->user()->id,
                        'url' => public_path('files'). "/" . $filename
                    ]
                );

                $order->files = json_encode($files);
                $order->update();
            }

        }

        return redirect()->back();
        
    }
}