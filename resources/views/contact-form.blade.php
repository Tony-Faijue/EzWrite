@extends('layouts.layout')

@section('content')
    <div class="bg-grad-4">
        <div class="user-form-bg">
            <div class="pb-8">
                <h1 class="heading-form-title">Contact Form</h1>
                <form id="contactForm" name="contactForm" method="POST" action="{{ route('contacts-create') }}"
                    class="space-y-5">
                    @csrf

                    <!--Email-->
                    <div>
                        <label for="email" class="block label-form mb-1">Email</label>
                        <input type="text" id="email" name="email" placeholder="youremail@example.com" required
                            class="input-form input-form-focus" />
                    </div>
                    <!--Subject-->
                    <div>
                        <label for="subject" class="block label-form mb-1">Subject</label>
                        <input type="text" id="subject" name="subject" placeholder="Subject" required
                            class="input-form input-form-focus" />
                    </div>
                    <!--Message-->
                    <div>
                        <label for="message" class="block label-form mb-1">Message</label>
                        <textarea id="message" name="message" placeholder="Message" required
                            class="input-form input-form-focus"></textarea>
                    </div>
                    <!--Submit Button-->
                    <div class="flex justify-center mt-4">
                        <button class="msg-btn">Message</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection