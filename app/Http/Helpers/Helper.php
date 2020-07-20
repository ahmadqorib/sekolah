<?php 

if (! function_exists('notice')) {
    function notice($labelClass, $content) {
        $notices = Session::get('notice');
        if(! is_array( $notices ))
            $notices = [];

        array_push($notices, [
            'labelClass' => $labelClass,
            'content' => $content
        ]);

        Session::put('notice', $notices);
    }
}

if (!function_exists('convert_date_ind')) {
    function convert_date_ind($value, $format = '%d %B %Y')
    {
        if (empty($value)) {
            return '-';
        }

        setlocale(LC_TIME, 'id_ID.utf8');
        \Carbon\Carbon::setLocale('id');
        return \Carbon\Carbon::parse($value)->formatLocalized($format);
    }
}

if (!function_exists('size_file')) {
    function size_file($fileName, $path)
    {
        $file = 'uploads/'.$path.'/'.$fileName;
        return \Storage::disk(config('filesystems.default'))->size($file);
    }
}