<?php

namespace App\Http\Controllers\Writers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\User;
use App\Models\File;
use App\Models\Invoice;
use App\Models\InvoiceList;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index(){
        $orders = Order::where('writer_id', Auth::user()->id)->get();
        $finished = 0;
        $revision = 0;
        $processing = 0;
        $disputed = 0;

        foreach ($orders as $order) {
            if($order->status == 'processing'){
                $processing++;
            }else if($order->status == 'revision'){
                $revision++;
            }else if($order->status == 'disputed'){
                $disputed++;
            }else if($order->status == 'finished'){
                $finished++;
            }
        }

        return view('writers.dashboard')
            ->with('finished', $finished)
            ->with('disputed', $disputed)
            ->with('revision', $revision)
            ->with('processing', $processing);
    }
    
    public function orders(){
        $myOrders = Order::where('writer_id', Auth::user()->id)
            ->get();
        $orders = Order::where('status', 'available')->get();

        return view('writers.orders')
            ->with('myOrders', $myOrders)
            ->with('orders', $orders);
    }
    
    public function orderShow(Order $order){
        $files = File::where('order_id', $order->id)->get();
        return view('writers.show')
            ->with('order', $order)
            ->with('files', $files);
    }

    public function takeOrder(Order $order){

        $myOrders = Order::where('writer_id', Auth::user()->id)
        ->where('status', 'processing')
        ->count();

        if($myOrders >= 2){
            return redirect()->back()->with('message', 'First Complete Orders in Progress');
        }

        $order->status = 'processing';
        $order->writer_id = Auth::user()->id;
        $order->update();
        
        return redirect()->route('writer.orders.show', $order);
    }
    
    public function completeOrder(Request $request, Order $order){
        // upload file first
        $order->status = 'completed';
        return $this->uploadFiles($request, $order);
    }

    public function money(){
        $invoices = Invoice::where('writer_id', Auth::user()->id)->get();
        return view('writers.money')->with('invoices', $invoices);
    }

    public function fullInvoice(Invoice $invoice){
       $invoiceList = InvoiceList::where('writer_id', Auth::user()->id)
        ->where('invoice_id', $invoice->id)
        ->get();
            
       return view('writers.money_list')
        ->with('invoice', $invoice)
        ->with('invoiceList', $invoiceList);
    }

    public function settings(){
        return view('writers.settings');
    }

    public function download(File $file){
        return response()->download($file->url);
    }

    private function uploadFiles(Request $request, Order $order){
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

    public function profile(){
        return view('writers.profile');
    }
}