<?php

namespace APP\Traits;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

trait FileControlTrait
{
    /**
     * Upload a file to the specified directory and disk.
     *
     * @param UploadedFile $file
     * @param string $directory
     * @param string $disk
     * @return string|null
     * @throws ValidationException
     */

    public function uploadFile(UploadedFile $file, string $directory, string $disk = 'public'): ?string
    {

        // $this->validateFile($file);

        if ($file) {
            $filename = uniqid() . '_' . time() . '.' . $file->getClientOriginalExtension();
            $filePath = $file->storeAs($directory, $filename, $disk);
            return $filePath;
        }

        return null;
    }

    /**
     * Delete a file from the specified disk.
     *
     * @param string|null $filePath
     * @param string $disk
     * @return bool
     */
    public function deleteFile(?string $filePath, string $disk = 'public'): bool
    {
        if ($filePath && Storage::disk($disk)->exists($filePath)) {
            return Storage::disk($disk)->delete($filePath);
        }

        return false;
    }

    // protected function validateFile(UploadedFile $file): void
    // {
    //     $validator = Validator::make(
    //         ['file' => $file],
    //         [
    //             'file' => 'required|mimes:jpeg,png,gif|max:5120', // Max size is 5120KB (5MB)
    //         ]
    //     );

    //     if ($validator->fails()) {
    //         throw new ValidationException($validator);
    //     }
    // }
}