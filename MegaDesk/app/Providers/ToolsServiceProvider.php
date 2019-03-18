<?php
/*
 * File: c:\Users\grosales\Documents\project-falcon\Project-Falcon\app\Providers\ToolsServiceProvider.php
 * Project: c:\Users\grosales\Documents\project-falcon\Project-Falcon
 * Created Date: Thursday, January 31st 2019, 12:09:28 pm
 * Author: Gabriel Rosales
 * -----
 * Date Modified: 01/31/2019, 12:14:32
 * Modified By: Gabriel Rosales
 * -----
 * Copyright (c) 2019 Avuncular Digital
 * MIT License
 *
 * Copyright (c) 2019 Avuncular Digital
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy of
 * this software and associated documentation files (the "Software"), to deal in
 * the Software without restriction, including without limitation the rights to
 * use, copy, modify, merge, publish, distribute, sublicense, and/or sell copies
 * of the Software, and to permit persons to whom the Software is furnished to do
 * so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in all
 * copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
 * SOFTWARE.
 * -----
 * HISTORY:
 * Date      	By	Comments
 * ----------	---	----------------------------------------------------------
 */
namespace App\Providers;
use Illuminate\Support\ServiceProvider;
use App\Tools\BusinessDays;

class ToolsServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind('BusinessDays', function () {
            return new BusinessDays;
        });
    }
}
