@component('mail::message')
# 📩 New Callback Request Received

**Name:** {{ $data['name'] }}  
**Email:** {{ $data['email'] }}  
**Mobile:** {{ $data['mobile'] }}

---

**Message:**  
{{ $data['message'] }}

@endcomponent
