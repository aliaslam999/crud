<?php

namespace App\Http\Controllers;

use App\Models\Pdf;
use App\Models\User;
use App\Mail\SendMail;
use App\Jobs\SendMailJob;
use Illuminate\Http\Request;
use Smalot\PdfParser\Parser; 
use Illuminate\Support\Facades\Mail;

class UserModelController extends Controller
{

    public function index()
    {
        return view('email.email_form');
    }
    public function send(Request $request)
    {
        // echo "<pre>";
        // print_r($request->name);
        // exit;
        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'des' => $request->des,
        ];
        Mail::to($data['email'])->send(new SendMail($request));


        // $var = SendMailJob::dispatch($data);
        // if ($var) {
        //     echo "success";
        //     return redirect()->back();
        // }
        $users = User::all();



        // foreach ($users as $user) {
        //     // echo "<pre>";
        //     // print_r($user->email);
        //     // exit;
        //     SendMailJob::dispatch($user->email);
        //     echo "success";
        // }
    }


    public function pdf(Request $request)
    {
        $request->validate([
            'pdf' => 'required|mimes:pdf|max:10000', // Validate the file
        ]);

        $path = $request->file('pdf')->store('pdfs');
        
        $parser = new Parser();
        $pdf = $parser->parseFile(storage_path('app/' . $path));
        $extractedText = $pdf->getText();
        
        // echo "<pre>";print_r($extractedText);exit;
        $pdfText = new Pdf();
        $pdfText->text = $extractedText;
        $pdfText->save();

        return redirect()->back()->with('success', 'PDF text extracted and saved successfully!');
    }
}
