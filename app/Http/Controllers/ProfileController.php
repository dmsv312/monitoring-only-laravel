<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Http;


use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;
use Inertia\Response;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): Response
    {
        $urls = [
            [
                'nodeName' => 'nodesUP',
                'serverName' => 'Graph MonteCristo test',
                'url' => 'http://135.181.116.242:36657/status'
            ],
            [
                'nodeName' => 'n83707',
                'serverName' => 'Graph 1 main',
                'url' => 'http://65.108.45.163:36657/status'
            ],
            [
                'nodeName' => 'tarasov',
                'serverName' => 'Graph 4 Indexer test',
                'url' => 'http://65.21.197.233:46657/status'
            ],
            [
                'nodeName' => 'iamnoderunner',
                'serverName' => 'Graph 1 testnet',
                'url' => 'http://135.181.222.190:36657/status'
            ],
            [
                'nodeName' => 'digital-am',
                'serverName' => 'Graph Draculla test',
                'url' => 'http://135.181.116.223:36657/status'
            ],
            [
                'nodeName' => 'omeganodes',
                'serverName' => 'Graph MonteCristo main',
                'url' => 'http://95.217.105.224:36657/status'
            ],
            [
                'nodeName' => 'webfarm3',
                'serverName' => 'Graph Draculla main',
                'url' => 'http://157.90.4.172:36657/status'
            ],
            [
                'nodeName' => 'nodist',
                'serverName' => 'Graph 4 Indexer main',
                'url' => 'http://157.90.95.31:36657/status'
            ],
            [
                'nodeName' => 'team03baikal',
                'serverName' => 'Germany1',
                'url' => 'http://94.130.132.22:36657/status'
            ],
            [
                'nodeName' => 'valleynodes',
                'serverName' => 'Germany2',
                'url' => 'http://94.130.131.217:36657/status'
            ],
            [
                'nodeName' => 'infrachains',
                'serverName' => 'Germany3',
                'url' => 'http://78.46.99.59:36657/status'
            ],
//            [
//                'nodeName' => 'jitsunetwork',
//                'serverName' => 'Mongolia',
//                'url' => 'http://202.179.22.176:26657/status'
//            ],
            [
                'nodeName' => 'cherenokping',
                'serverName' => 'Kazakhstan',
                'url' => 'http://146.158.65.215:26657/status'
            ],
            [
                'nodeName' => 'mountblancpoint',
                'serverName' => 'Thai 1',
                'url' => 'http://113.53.82.252:36657/status'
            ],
            [
                'nodeName' => 'tennischain',
                'serverName' => 'Arbitrum 1',
                'url' => 'http://116.202.114.46:26657/status'
            ],
            [
                'nodeName' => 'forwardspedchain',
                'serverName' => 'Arbitrum MonteCristo',
                'url' => 'http://148.251.87.24:26657/status'
            ],
            [
                'nodeName' => 'firstclassnodes',
                'serverName' => 'Arbitrum 4',
                'url' => 'http://195.201.61.112:26657/status'
            ],
        ];
        $responseArray = [];
        /** @var array $url */
        foreach ($urls as $url) {
            $response = Http::get($url['url']);
            $responseArray [] = [
                'response' => $response->object(),
                'nodeData' => $url
            ];
        }

        return Inertia::render('Profile/Edit', [
            'mustVerifyEmail' => $request->user() instanceof MustVerifyEmail,
            'status' => session('status'),
            'responses' => $responseArray,
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        return Redirect::route('profile.edit');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validate([
            'password' => ['required', 'current-password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
