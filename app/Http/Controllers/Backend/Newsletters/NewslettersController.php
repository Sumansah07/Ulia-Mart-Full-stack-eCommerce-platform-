<?php

namespace App\Http\Controllers\Backend\Newsletters;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\SubscribedUser;
use App\Models\EmailTemplate;
use Mail;
use App\Mail\EmailManager;

class NewslettersController extends Controller
{
    # construct
    public function __construct()
    {
        $this->middleware(['permission:newsletters'])->only(['index', 'sendNewsletter']);
    }

    # newsletter sending page
    public function index(Request $request)
    {
        $users = User::where('user_type' , '!=', 'admin')->where('user_type', '!=' , 'staff')->get();
        $subscribers = SubscribedUser::all();
        $templates = EmailTemplate::active()->get();

        // Get customers who have made purchases
        $customersWithOrders = User::where('user_type', 'customer')
                                  ->whereNotNull('email')
                                  ->whereHas('orders')
                                  ->get();

        return view('backend.pages.newsletters.index', compact('users', 'subscribers', 'templates', 'customersWithOrders'));
    }

    # send newsletter
    public function sendNewsletter(Request $request)
    {
        $request->validate([
            'subject' => 'required|string|max:255',
            'content' => 'required|string',
        ]);

        if (env('MAIL_USERNAME') != null) {
            $totalSent = 0;
            $totalFailed = 0;

            // Use template if selected
            $content = $request->content;
            if ($request->filled('template_id')) {
                $template = EmailTemplate::find($request->template_id);
                if ($template) {
                    // Load saved sample variables from storage
                    $file = storage_path('app/email_template_sample_variables.json');
                    if (file_exists($file)) {
                        $sampleVariables = json_decode(file_get_contents($file), true);
                    } else {
                        // Fallback to default variables
                        $sampleVariables = [
                            '{{CUSTOMER_NAME}}' => 'Valued Customer',
                            '{{CUSTOMER_EMAIL}}' => 'customer@example.com',
                            '{{OFFER_TITLE}}' => 'Special Offer',
                            '{{OFFER_DESCRIPTION}}' => 'Check out our latest products and offers',
                            '{{DISCOUNT_PERCENTAGE}}' => '10',
                            '{{PROMO_CODE}}' => 'SPECIAL10',
                            '{{VALID_UNTIL}}' => date('F j, Y', strtotime('+30 days')),
                        ];
                    }
                    $content = $template->renderContent($sampleVariables);
                }
            }

            //sends newsletter to subscribed users
            if ($request->has('subscriber_emails')) {
                foreach ($request->subscriber_emails as $key => $email) {
                    $array['view'] = 'emails.marketing.newsletter';
                    $array['subject'] = $request->subject;
                    $array['from'] = env('MAIL_FROM_ADDRESS');
                    $array['content'] = $content;
                    try {
                        Mail::to($email)->queue(new EmailManager($array));
                        $totalSent++;
                    } catch (\Exception $e) {
                        $totalFailed++;
                        \Log::error('Newsletter email failed: ' . $e->getMessage(), ['email' => $email]);
                    }
            	}
            }

            //sends newsletter to users (customers)
        	if ($request->has('user_emails')) {
                foreach ($request->user_emails as $key => $email) {
                    $array['view'] = 'emails.marketing.newsletter';
                    $array['subject'] = $request->subject;
                    $array['from'] = env('MAIL_FROM_ADDRESS');
                    $array['content'] = $content;

                    try {
                        Mail::to($email)->queue(new EmailManager($array));
                        $totalSent++;
                    } catch (\Exception $e) {
                        $totalFailed++;
                        \Log::error('Newsletter email failed: ' . $e->getMessage(), ['email' => $email]);
                    }
            	}
            }

            //sends newsletter to customers with orders
            if ($request->has('customer_emails')) {
                foreach ($request->customer_emails as $key => $email) {
                    $array['view'] = 'emails.marketing.newsletter';
                    $array['subject'] = $request->subject;
                    $array['from'] = env('MAIL_FROM_ADDRESS');
                    $array['content'] = $content;

                    try {
                        Mail::to($email)->queue(new EmailManager($array));
                        $totalSent++;
                    } catch (\Exception $e) {
                        $totalFailed++;
                        \Log::error('Newsletter email failed: ' . $e->getMessage(), ['email' => $email]);
                    }
                }
            }

            $message = localize('Newsletter sent successfully') . ". " . localize('Sent: ') . $totalSent;
            if ($totalFailed > 0) {
                $message .= ", " . localize('Failed: ') . $totalFailed;
            }
            flash($message)->success();
        } else {
            flash(localize('Please configure SMTP first'))->error();
            return back();
        }

    	return back();
    }
}
