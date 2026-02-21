<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\V1\Garage;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

final class StripeConnectController extends Controller
{
    public function __invoke(Request $request): JsonResponse
    {
        /** @var User $user */
        $user = $request->user();

        if (!$user->isGarage()) {
            return response()->json([
                'message' => 'Seuls les garages peuvent configurer Stripe.',
            ], 403);
        }

        $stripeKey = config('services.stripe.key');
        
        if (empty($stripeKey)) {
            return response()->json([
                'message' => 'Stripe non configuré. Ajoutez STRIPE_KEY dans .env',
                'setup_required' => true,
            ]);
        }

        return response()->json([
            'message' => 'Configuration Stripe',
            'has_stripe_customer' => !empty($user->stripe_customer_id),
            'has_stripe_connect' => !empty($user->stripe_connect_id),
            'onboarding_url' => $this->generateOnboardingUrl($user),
        ]);
    }

    private function generateOnboardingUrl(User $user): ?string
    {
        if (empty(config('services.stripe.secret'))) {
            return null;
        }

        return route('stripe.onboard.refresh', ['user' => $user->id]);
    }
}
