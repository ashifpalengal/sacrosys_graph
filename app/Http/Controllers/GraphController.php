<?php

namespace App\Http\Controllers;

use App\Models\Area;
use App\Models\Customer;
use App\Models\Invoice;
use App\Models\Salesman;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Rap2hpoutre\FastExcel\FastExcel;


class GraphController extends Controller
{

    public function index()
    {
        $date = Carbon::today()->subDays(30)->format('m/d/Y') . ' - ' . Carbon::today()->format('m/d/Y');
        return view('welcome',['date' => $date]);
    }

    public function loadData(Request $request)
    {
        $start_date = Carbon::createFromFormat('m/d/Y', substr($request->date, 0, 10));
        $end_date = Carbon::createFromFormat('m/d/Y', substr($request->date, -10));

        $invoices = Invoice::whereBetween('invoice_date', [$start_date, $end_date]);

        $total_sales = $invoices->sum('invoice_amount');
        $max_invoice_val = $invoices->max('invoice_amount');
        $avg_invoice_val = round($invoices->avg('invoice_amount'),2);
        $no_of_order = $invoices->count();


        // top 5 customers
        $customers = Customer::withSum(['invoices' => function ($query) use ($start_date, $end_date) {
                $query->whereBetween('invoice_date', [$start_date, $end_date]);
            }], 'invoice_amount')
            ->orderByDesc('invoices_sum_invoice_amount')
            ->limit(5)
            ->get();

        $customer_chart [] = ['Customer', 'Amount'];

        foreach ($customers as $customer) {
            $customer_chart [] = [$customer->name, (float) ($customer->invoices_sum_invoice_amount)];
        }

        // end 5 customer


        // area sales donut
        $area_sales[] = ['Area', 'Sales Amount'];

        $areas = Area::with(['salesmen.invoices' => function($query) use ($start_date, $end_date) {
            $query->whereBetween('invoice_date', [$start_date, $end_date]);
        }])->get();

        foreach($areas as $area) {
            $total_amount = 0;
            foreach($area->salesmen as $salesman) {
                $total_amount += $salesman->invoices->sum('invoice_amount');
            }
            $area_sales[] = [$area->name, $total_amount];
        }

        // area sales donut end


        // sales target
        $sales_target[] = ['Sales Man', 'Sales', 'Target'];


        $salesmen = Salesman::withSum('invoices', 'invoice_amount')->get();

        $start_of_month = Carbon::now()->startOfMonth();
        $end_of_month = Carbon::now()->endOfMonth();

        foreach($salesmen as $salesman) {

            $actual_sales = $salesman->invoices()
            ->whereBetween('invoice_date', [$start_of_month, $end_of_month])
            ->sum('invoice_amount');

            $sales_target[] = [$salesman->name, (float) $actual_sales, (float) $salesman->target];

            // $sales_target[] = [$salesman->name, (float) $salesman->invoices_sum_invoice_amount, (float) $salesman->target];
        }

        // sales target end

        //comparison
        $last_30_days = Carbon::today()->subDays(30);
        $last_60_days = Carbon::today()->subDays(60);

        $second_last_month = Invoice::where('invoice_date', '>=', $last_60_days)->where('invoice_date', '<', $last_30_days)->get();
        $last_month = Invoice::where('invoice_date', '>=', $last_30_days)->get();

        $month = [
            ['Month', 'Sales Amount'],
            ['Last Month',  (float) $last_month->sum('invoice_amount')],
            ['Second Last Month',  (float) $second_last_month->sum('invoice_amount')]
        ];


        // week sales

        $week[] = ['week', 'Sales Amount'];
        $startDate = Carbon::now()->subWeeks(8);

        for ($i = 0; $i < 8; $i++) {

            $endDate = $startDate->copy()->addDays(6);

            $week_data = Invoice::whereBetween('invoice_date', [$startDate, $endDate])->get();

            $week[] = ['week '.($i+1), (float) $week_data->sum('invoice_amount')];

            $startDate->addWeek();
        }

        //comparison end

        return [
            "customer_chart" => $customer_chart,

            'location_sales' => $area_sales,

            'comparison_chart' => [
                'week' => $week,
                'month' => $month
            ],

            'sales_target' => $sales_target,

            'no_of_order' => $no_of_order,
            'avg_invoice_val' => $avg_invoice_val,
            'max_invoice_val' => $max_invoice_val ?? 0,
            'total_sales' => $total_sales
        ];

    }


    public function loadDataFromFile()
    {
        // dd('block');
        // $countttt = 0;

        // $rows = (new FastExcel)->import('C:\Users\user\Downloads\Data.xlsx - InvoiceHeader.csv');

        // $error_data = [];

        // foreach ($rows as $key => $value) {
        //         try {

        //         $invoice = new Invoice();

        //         $invoice->invoice_id = (int) $value['InvoiceID'];
        //         $invoice->invoice_no = $value['InvoiceNumber'];

        //         $invoice->invoice_date = (Carbon::createFromFormat('d/m/Y H:i:s', $value['InvoiceDate']))->toDateTimeString();

        //         $invoice->invoice_amount = (float) str_replace(",", "", $value[' InvoiceAMount ']);

        //         $invoice->customer_id = (int) $value['CustomerID'];
        //         $invoice->salesmen_id = (int) $value[' SalesManId '];
        //         $invoice->save();

        //     } catch (\Exception $th) {
        //         $error_data [] = $value;
        //         $countttt++;
        //         continue;
        //     }

        // }
    }
}
