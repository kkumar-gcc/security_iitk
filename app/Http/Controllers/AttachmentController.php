<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAttachmentRequest;
use App\Http\Requests\UpdateAttachmentRequest;
use App\Models\Attachment;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Inertia\Inertia;
use Inertia\Response;

class AttachmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Inertia::render('Attachments/Index', [
            'attachments' => Attachment::query()
                ->when(request('search'), function ($query, $search) {
                    $query->where('name', 'LIKE', "%{$search}%")
                        ->orWhere('mime_type', 'LIKE', "%{$search}%");
                })
                ->where('user_id', auth()->user()->id)
                ->paginate(request('per_page', 25))
                ->withQueryString(),
            'filters' => request()->only(['search']),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreAttachmentRequest $request): RedirectResponse|JsonResponse
    {
        $files = $request->file('attachments');
        $attachments = [];
        foreach ($files as $file) {
            $attachments[] = Attachment::create([
                'name' => $file->getClientOriginalName(),
                'mime_type' => $file->getClientMimeType(),
                'path' => $file->store('attachments'),
                'user_id' => auth()->user()->id,
            ]);
        }

        return response()->json([
            'message' => 'Attachments uploaded.',
            'attachments' => $attachments,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): Response
    {
        return Inertia::render('Attachments/Create');
    }

    /**
     * Display the specified resource.
     */
    public function show(Attachment $attachment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Attachment $attachment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateAttachmentRequest $request, Attachment $attachment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Attachment $attachment)
    {
        $attachment->delete();

        return redirect()->back()->with('success', 'Attachment deleted.');
    }
}
