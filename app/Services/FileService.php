<?php

namespace App\Services;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\ValidationException;

class FileService
{
    public function getUrl($data, $path, $target)
    {
        foreach ($data as $key => $item) {
            $item->$target = Storage::url("public/$path/" . $item->$target);
        }
        return $data;
    }

    public function store($file, $path, $firstName = "Pb")
    {
        try {
            $file_name = $firstName . date('ymdHi') . '.' . $file->getClientOriginalExtension();
            $file->storeAs('public/' . $path, $file_name);
            return $file_name;
        } catch (\Throwable $th) {
            throw ValidationException::withMessages(['UploadFile' => config('app.env') == 'local' ? $th->getMessage() : 'The file failed to uploaded!']);
        }
    }

    public function change($file, $path, $oldFile, $firstName = 'Pb')
    { //Pb = public
        try {
            $file_name = $firstName . date('ymdHi') . '.' . $file->getClientOriginalExtension();
            $file->storeAs('public/' . $path, $file_name);
            Storage::delete('public/' . $path . "/" . $oldFile);
            return $file_name;
        } catch (\Throwable $th) {
            throw ValidationException::withMessages(['UploadFile' => config('app.env') == 'local' ? $th->getMessage() : 'The file failed to changed!']);
        }
    }

    public function remove($fileName, $path)
    {
        try {
            Storage::delete('public/' . $path . '/' . $fileName);
        } catch (\Throwable $th) {
            throw ValidationException::withMessages(['UploadFile' => config('app.env') == 'local' ? $th->getMessage() : 'The file failed to uploaded!']);
        }
    }
}
