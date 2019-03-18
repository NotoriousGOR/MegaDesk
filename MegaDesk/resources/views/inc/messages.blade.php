{{--
    /*
 * File: c:\Users\grosales\Documents\project-falcon\Project-Falcon\resources\views\inc\messages.blade.php
 * Project: c:\Users\grosales\Documents\project-falcon\Project-Falcon
 * Created Date: Wednesday, January 9th 2019, 3:11:16 pm
 * Author: Gabriel Rosales
 * -----
 * Date Modified: 01/09/2019, 3:17:31
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
--}}


@if(count($errors) > 0)
    @foreach($errors->all() as $error)
        @push('scripts')
            <script>
                errorNoty =
                    new Noty({
                        text: '{{$error}}',
                        type:'error',
                        layout: 'centerRight',
                        timeout:3000
                    })
                    .on('onShow', function() {
                            var audio = new Audio('/sounds/alert.mp3');
                            audio.play();
                    }).show();
            </script>
        @endpush
    @endforeach
@endif

@if (session('success'))
    @push('scripts')
        <script>
            new Noty({
                text: '{{session('success')}}',
                type:'success',
                layout: 'topRight',
                timeout:3000
            })
            .on('onShow', function() {
                    var audio = new Audio('/sounds/appointed.mp3');
                    audio.play();
                }).show();
        </script>
    @endpush
@endif

@if(session('status'))
    @push('scripts')
        <script>
            $(document).ready(
                function() {
                    new Noty({
                    text: '{{session('status')}}',
                    type:'info',
                    layout:'topRight',
                    timeout:2000
                })
                .on('onShow', function() {
                        var audio = new Audio('/sounds/appointed.mp3');
                        audio.play();
                    }).show();
            });
        </script>
    @endpush
@endif

@if(session('error')) @push('scripts')
<script>
    $(document).ready(
                function() {
                    new Noty({
                    text: '{{session('error')}}',
                    type:'error',
                    layout:'topRight',
                    timeout:2000
                })
                .on('onShow', function() {
                        var audio = new Audio('/sounds/alert.mp3');
                        audio.play();
                    }).show();
            });
</script>

@endpush @endif
