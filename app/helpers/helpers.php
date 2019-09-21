<?php

if (!function_exists('apiResponse')) {
    function json_response($data = null, $message = null, $code = 200)
    {
        $array = [
            'status' => in_array($code, success_response()) ? true : false,
            'code' => $code,
            'data' => $data,
            'message' => $message,
        ];
        return response()->json($array);
    }

    function success_response()
    {
        return [
            200,   //OK. The standard success code and default option.
            201,   //Object created. Useful for the store actions.
            202,   //The request has been accepted for processing, but the processing has not been completed.
            204,   //No content. When an action was executed successfully, but there is no content to return.
            206,    //Partial content. Useful when you have to return a paginated list of resources.
        ];
    }

    /************** another http request codes **************/
    /* *
    *  400: Bad request. The standard option for requests that fail to pass validation.
    *  401: Unauthorized. The user needs to be authenticated.
    *  403: Forbidden. The user is authenticated, but does not have the permissions to perform an action.
    *  404: Not found. This will be returned automatically by Laravel when the resource is not found.
    *  405: Method Not Allowed.
    *  419: Authentication Timeout.
    *  422: Unprocessable Entity. validation failed.
    *  500: Internal server error. Ideally you're not going to be explicitly returning this, but if something unexpected breaks, this is what your user is going to receive.
    *  503: Service unavailable. Pretty self explanatory, but also another code that is not going to be returned explicitly by the application.
    * */

}

if (!function_exists('is_active')) {
    function is_active($name)
    {
        return request()->routeIs($name) ? 'active' : '';
    }
}

if (!function_exists('show_collapsed')) {
    function show_collapsed($name)
    {
        return is_active($name) ? 'show' : '';
    }
}

if (!function_exists('area_expand')) {
    function area_expand($name)
    {
        return request()->routeIs($name) ? 'true' : '';
    }
}

if (!function_exists('tooltip')) {
    function tooltip($title)
    {
        echo 'data-toggle="tooltip" data-placement="top" title="' . $title . '"';
    }
}

if (!function_exists('select_input_val')) {
    function select_input_val($value, $old = null, $exist = null)
    {
        if ($old) {
            echo $old == $value ? 'selected' : null;
        } else {
            echo $exist == $value ? 'selected' : null;
        }
    }
}

if (!function_exists('select_array_input_val')) {
    function select_array_input_val($value, $old = [], $exist = [])
    {
        if ($old) {
            echo in_array($value, $old) ? 'selected' : null;
        } else {
            echo in_array($value, $exist) ? 'selected' : null;
        }
    }
}

if (!function_exists('checkbox_input_val')) {
    function checkbox_input_val($value, $old = [], $exist = [])
    {
        if ($old) {
            echo in_array($value, $old) ? 'checked' : null;
        } else {
            echo in_array($value, $exist) ? 'checked' : null;
        }
    }
}
