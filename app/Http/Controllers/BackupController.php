<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Alert;
use Artisan;
use Log;
use Storage;
use Spatie\Backup\Helpers\Format;

class BackupController extends Controller
{
    function __construct()
    {
         $this->middleware('permission:backup-list|backup-create|backup-edit|backup-delete', ['only' => ['index','show']]);
         $this->middleware('permission:backup-create', ['only' => ['create','store']]);
         $this->middleware('permission:backup-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:backup-delete', ['only' => ['destroy']]);
    }

    public function index()
    {	
        $disk = Storage::disk(config('backup.backup.destination.disks')[0]);


        $files = $disk->files(config('backup.backup.name'));
        $backups = [];
        // make an array of backup files, with their filesize and creation date
        foreach ($files as $k => $f) {
            // only take the zip files into account
            if (substr($f, -4) == '.zip' && $disk->exists($f)) {
                $backups[] = [
                    'file_path' => $f,
                    'file_name' => str_replace(config('backup.backup.name') . '/', '', $f),
                    'file_size' => Format::humanReadableSize($disk->size($f)),
                    'last_modified' => $disk->lastModified($f),
                ]; 
            }
        }
        // reverse the backups, so the newest one would be on top
        $backups = array_reverse($backups);

        return view("admin.backup.backups")->with(compact('backups'));
    }

    public function create()
    {

    	try {
            // start the backup process
            // Artisan::call('backup:run --only-db');
            Artisan::call('backup:run');
            $output = Artisan::output();
            // log the results
            Log::info("Backpack\BackupManager -- new backup started from admin interface \r\n" . $output);
            // return the results as a response to the ajax call

            return redirect()->route('backup.index')
                        ->with('success','Database Backup  successful.');
        } catch (Exception $e) {
        	dd($e);
            return redirect()->route('backup.index')
                        ->with('error','Database Backup  Error.');

        }
    }

    public function download($file_name)
    {
        $file = config('backup.backup.name') . '/' . $file_name;
        $disk = Storage::disk(config('backup.backup.destination.disks')[0]);
        if ($disk->exists($file)) {
            $fs = Storage::disk(config('backup.backup.destination.disks')[0])->getDriver();
            $stream = $fs->readStream($file);
            return \Response::stream(function () use ($stream) {
                fpassthru($stream);
            }, 200, [
                "Content-Type" => $fs->getMimetype($file),
                "Content-Length" => $fs->getSize($file),
                "Content-disposition" => "attachment; filename=\"" . basename($file) . "\"",
            ]);
        } else {
            abort(404, "The backup file doesn't exist.");
        }
    }

    public function delete($file_name)
    {
        $disk = Storage::disk(config('backup.backup.destination.disks')[0]);
        if ($disk->exists(config('backup.backup.name') . '/' . $file_name)) {
            $disk->delete(config('backup.backup.name') . '/' . $file_name);
            return redirect()->route('backup.index')
                        ->with('success',' Backup  delete successful.');
        } else {
            abort(404, "The backup file doesn't exist.");
        }
    }
}
