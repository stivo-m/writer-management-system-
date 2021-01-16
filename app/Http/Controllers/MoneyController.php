<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Invoice;
use App\Models\InvoiceList;

class MoneyController extends Controller
{
    public function index(){
        $invoices = Invoice::get();
        return view('invoices.index')->with('invoices', $invoices);
    }

    public function invoiceList(Invoice $invoice){
        $invoiceList = InvoiceList::where('invoice_id', $invoice->id)->get();
        return view('invoices.invoiceList')->with('invoiceList', $invoiceList)->with('invoice', $invoice);
    }

    public function payInvoice(Invoice $invoice){
        if($invoice->status === 'not paid'){
            $invoiceList = InvoiceList::where('invoice_id', $invoice->id)->get();
            
            foreach ($invoiceList as $invoiceItem) {
                $invoiceItem->pay_status = 'paid';
                $invoiceItem->update();
            }
            $invoice->status = 'paid';
            $invoice->update();
        }
        
        return redirect()->route('money.invoice');
    }
}