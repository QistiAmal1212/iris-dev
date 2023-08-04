<?php

namespace App\Http\Controllers;

use App\Models\Email;
use App\Models\EmailRecipient;
use Illuminate\Http\Request;

class EmailController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /*^
    "entity_type" => "ReportHelpdesk"
    "entity_id" => "31"
    "email_type" => "TO"
    "email" => "dasdas"

     */

    //Add email, and refresh the email list uptodate
    public function addEmail(Request $request)
    {

        try {

            $validatedData = $request->validate([
                'email' => ['email'],
            ], [
                'email.email' => "Not a valid email address",
            ]);

            $email = Email::where('entity_type', $request->entity_type)->where('entity_id', $request->entity_id)->first();
            if (!$email) {
                $email = new Email(['entity_type' => $request->entity_type, 'entity_id' => $request->entity_id]);
                $email->save();
            }

            $emailRecipient = new EmailRecipient;
            $emailRecipient->email_id = $email->id;
            $emailRecipient->type = $request->email_type;
            $emailRecipient->email = $request->email;
            $emailRecipient->save();

            $emailArray = array();
            if ($request->email_type == "TO") {
                foreach ($email->emailRecipientTo as $recipient) {
                    $emailArray[] = $recipient->email;
                }
            } elseif ($request->email_type == "CC") {
                foreach ($email->emailRecipientCc as $recipient) {
                    $emailArray[] = $recipient->email;
                }
            } elseif ($request->email_type == "BCC") {
                foreach ($email->emailRecipientBcc as $recipient) {
                    $emailArray[] = $recipient->email;
                }
            }

        } catch (Throwable $exception) {
            Log::error($exception);
            return response()->json(['title' => 'Gagal', 'status' => 'error', 'detail' => $e->getMessage()], 404);
        }

        return response()->json(['title' => 'Berjaya', 'status' => 'success', 'email' => $emailArray]);

    }

    public function deleteEmail(Request $request)
    {

        try {
            EmailRecipient::destroy($request->email_recipient_id);

        } catch (Throwable $exception) {
            Log::error($exception);
            return response()->json(['title' => 'Gagal', 'status' => 'error', 'detail' => $e->getMessage()], 404);
        }

        return response()->json(['title' => 'Berjaya', 'status' => 'success']);

    }
}
