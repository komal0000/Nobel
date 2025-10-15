@component('mail::message')
# 📩 New Feedback Received

**Name:** {{ $data['name'] }}  
**Email:** {{ $data['email'] }}  
**Mobile:** {{ $data['mobile'] }}

---

**Message:**  
{{ $data['message'] }}

@endcomponent
