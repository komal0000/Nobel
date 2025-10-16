@component('mail::message')

# New Job Application: {{ $data['job_title'] ?? '' }}

**Job:** {{ $data['job_title'] ?? '' }}

---

## Applicant Details
- **Name:** {{ $data['applicant']['name'] ?? '' }}
- **Email:** {{ $data['applicant']['email'] ?? '' }}
- **Contact Number:** {{ $data['applicant']['contactNumber'] ?? '' }}
- **Date of Birth:** {{ $data['applicant']['dob'] ?? '' }}
- **Gender:** {{ $data['applicant']['gender'] ?? '' }}
- **Fresher/Experience:** {{ ($data['applicant']['exp'] ?? '') == '1' ? 'Experience' : (($data['applicant']['exp'] ?? '') === '0' ? 'Fresher' : ($data['applicant']['exp'] ?? '')) }}

## Professional Details
- **Organization:** {{ $data['professional']['orgName'] ?? '' }}
- **Current Annual CTC:** {{ $data['professional']['currentCost'] ?? '' }}
- **Expected Annual CTC:** {{ $data['professional']['expectedCost'] ?? '' }}
- **Notice Period (days):** {{ $data['professional']['noticePeriod'] ?? '' }}
- **Current Designation:** {{ $data['professional']['currentDesignation'] ?? '' }}
- **Department:** {{ $data['professional']['department'] ?? '' }}
- **Years of Experience:** {{ $data['professional']['yearExp'] ?? '' }}
- **Reason for Change:** {{ $data['professional']['changeReason'] ?? '' }}

## Education
- **Institution:** {{ $data['education']['institution'] ?? '' }}
- **Degree:** {{ $data['education']['degree'] ?? '' }}
- **Year of Completion:** {{ $data['education']['completionYear'] ?? '' }}
- **Percentage / CGPA:** {{ $data['education']['securedPercent'] ?? '' }}

## Message
{{ $data['message'] ?? 'N/A' }}

@if(!empty($data['resume']))
## Resume
You will find the resume attached to this email.
@endif
@endcomponent
