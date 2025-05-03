@extends('front.layout.app')
@section('metaData')
   @includeIf('front.cache.meta.career.job.' . $slug . '-form')
@endsection

@section('content')
   @includeIf('front.cache.career.job.' . $slug . '-form')
@endsection
@section('js')
   <script>
      $(document).ready(function () {
        console.log('working');

        const $input = $('#dob');
        const today = new Date();
        const minDiff = new Date(
          today.getFullYear() - 18,
          today.getMonth(),
          today.getDate()
        );

        const maxDate = minDiff.toISOString().split('T')[0];
        console.log(maxDate);

        $input.attr('max', maxDate);

        const $para = $('.para-wrap');
        const $btn = $('.read-more-btn');

        function checkOverflow() {
          const $clone = $para.clone()
            .css({
               display: 'block',
               visibility: 'hidden',
               position: 'absolute',
               width: $para.width(),
               maxHeight: 'none',
               overflow: 'visible'
            })
            .appendTo('body');

          const fullHeight = $clone[0].scrollHeight;
          const displayHeight = $para.height();

          $clone.remove();
          return fullHeight > displayHeight;
        }

        if (checkOverflow()) {
          $btn.show();
          $para.addClass('collapsed');
        } else {
          $btn.hide();
          $para.removeClass('collapsed');
        }

        $btn.on('click', function () {
          $para.toggleClass('collapsed');
          $(this).html($para.hasClass('collapsed') ? 'Read More <i class="bi bi-chevron-down"></i>' :
            'Read Less <i class="bi bi-chevron-up"></i>');
        });
      });

      const $steps = $('.form-step');
      const $stepCount = $('.step-count');
      let currentStep = 0;

      function showStep(index) {
        console.log(index, 'index');

        $steps.removeClass('active').eq(index).addClass('active');
        $stepCount.removeClass('active');
        $(`.step-count-${index}`).addClass('active');
      }

      $('.next').on('click', function () {
        const $form = $('#multiStepForm')[0];
        const $currentFields = $steps.eq(currentStep).find(':input');

        // Temporarily disable all other fields to validate only current step
        const $allInputs = $('#multiStepForm :input').prop('disabled', true);
        $currentFields.prop('disabled', false);

        if (!$form.checkValidity()) {
          $form.reportValidity();
          $allInputs.prop('disabled', false);
          return;
        }

        $allInputs.prop('disabled', false);
        currentStep++;
        showStep(currentStep);
      });

      $('.prev').on('click', function () {
        currentStep--;
        showStep(currentStep);
      });

      $('#form-step-3').on('submit', function (e) {
        e.preventDefault();
        //   alert('form submitted');
      })

      $('#multiStepForm').on('submit', function (event) {
        event.preventDefault(); // Prevent default form submission

        // Create spinner or loading indicator
        const $submitBtn = $('#formSubmit');
        $submitBtn.prop('disabled', true).html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Submitting...');

        const formData = new FormData(this); // Collect all form inputs

        // Log the raw form data for debugging
        console.log('Form data being submitted:');
        for (const pair of formData.entries()) {
          console.log(pair[0], ':', pair[1]);
        }

        // Validate resume file before submission
        const resumeFile = formData.get('resume');
        if (!resumeFile || !resumeFile.name) {
          alert('Please select a resume file (PDF or DOCX format)');
          $submitBtn.prop('disabled', false).html('Submit');
          return;
        }

        // Set the correct content type for resume file
        const fileExtension = resumeFile.name.split('.').pop().toLowerCase();
        if (fileExtension !== 'pdf' && fileExtension !== 'doc' && fileExtension !== 'docx') {
          alert('Resume must be in PDF or DOCX format');
          $submitBtn.prop('disabled', false).html('Submit');
          return;
        }

        // Validate completion year (must be 4 digits)
        const completionYear = formData.get('completionYear');
        if (!/^\d{4}$/.test(completionYear)) {
          alert('Year of completion must be exactly 4 digits');
          $submitBtn.prop('disabled', false).html('Submit');
          return;
        }

        // Validate secured percent (must be numeric)
        const securedPercent = formData.get('securedPercent');
        if (securedPercent === '' || isNaN(securedPercent)) {
          alert('Percentage secured or CGPA must be a valid number');
          $submitBtn.prop('disabled', false).html('Submit');
          return;
        }

        // The form data is already correctly formatted, no need to recreate it
        // Just use the original formData object directly

        $.ajax({
          url: $(this).attr('action'), // Use the form's action attribute
          type: 'POST',
          data: formData, // Use the original FormData directly
          processData: false, // Important for FormData
          contentType: false, // Important for FormData
          headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          },
          success: function (response) {
            alert(response.message || 'Your application has been submitted successfully!');
            location.reload();
          },
          error: function (xhr, status, error) {
            // Enable the submit button again
            $submitBtn.prop('disabled', false).html('Submit');

            // Handle validation errors
            if (xhr.status === 422) {
               try {
                 const errors = xhr.responseJSON.errors;
                 let errorMessage = 'Please correct the following errors:\n\n';

                 for (const field in errors) {
                   errorMessage += `• ${errors[field][0]}\n`;
                 }

                 alert(errorMessage);
               } catch (e) {
                 alert('Form validation failed. Please check your inputs and try again.');
               }
            } else {
               alert('An error occurred while submitting your application. Please try again.');
            }
            console.error('Error details:', xhr.responseJSON);
          }
        });
      });



   </script>
@endsection