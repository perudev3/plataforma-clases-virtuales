<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;
use App\Course;
use App\User;

class CheckoutController extends Controller
{

    private function createPayment(Course $course)
    {
        $amountInCents = (int) ($course->price_display=='regular'? $course->price : $course->discount_price * 100);

        return Http::withBasicAuth(
            config('services.izipay.username'),
            config('services.izipay.password_test')
        )->post(
            'https://api.micuentaweb.pe/api-payment/V4/Charge/CreatePayment',
            [
                "amount"   => $amountInCents,
                "currency" => "PEN",
                "orderId"  => uniqid('ORDER_'),
                "customer" => [
                    "email" => auth()->user()->email
                ]
            ]
        )->json();
    }


    public function show(Course $course)
    {
        return view('checkout', compact('course'));
    }

    public function pay(Course $course)
    {
        $amountInCents = (int) ($course->price_display=='regular'? $course->price : $course->discount_price * 100);

        $orderId = 'COURSE_'.$course->id.'_'.uniqid();

        $response = Http::withBasicAuth(
            config('services.izipay.username'),
            config('services.izipay.password_test')
        )->post(
            'https://api.micuentaweb.pe/api-payment/V4/Charge/CreatePayment',
            [
                "amount"   => $amountInCents,
                "currency" => "PEN",
                "orderId"  => $orderId,
                "customer" => [
                    "email" => auth()->user()->email
                ]
            ]
        );

        $data = $response->json();

        if ($data['status'] !== 'SUCCESS') {
            return back()->with('error', 'Error al generar el pago');
        }

        $formToken = $data['answer']['formToken'];

        return view('izipay.payment', compact('formToken'));
    }

   public function webhook(Request $request)
{
    $data = $request->all(); // 🔥 ESTO FALTABA

    if (
        isset($data['answer']['clientAnswer']['orderStatus']) &&
        $data['answer']['clientAnswer']['orderStatus'] === 'PAID'
    ) {

        $email = $data['answer']['clientAnswer']['customer']['email'] ?? null;
        $orderId = $data['answer']['clientAnswer']['orderDetails']['orderId'] ?? null;

        if ($email && $orderId) {

            $user = User::where('email', $email)->first();

            if ($user) {

                preg_match('/COURSE_(\d+)_/', $orderId, $matches);
                $courseId = $matches[1] ?? null;

                if ($courseId) {

                    $course = Course::find($courseId);

                    if ($course) {

                        $alreadyEnrolled = $user->courses()
                            ->where('course_id', $course->id)
                            ->exists();

                        if (!$alreadyEnrolled) {
                            $user->courses()->attach($course->id, [
                                'enrolled_at' => now(),
                                'created_at'  => now(),
                                'updated_at'  => now(),
                            ]);
                        }
                    }
                }
            }
        }
    }

    return response()->json(['status' => 'ok']);
}
}
