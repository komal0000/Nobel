<section id="job-form-header">
   <div class="main-container">
      <div class="desc">
         <div class="heading mb-3">{{$job->title}} </div>
         <div class="content-wrapper mb-3">
            <div class="para-wrap collapsed">
               {!! $job->description !!}
            </div>
            <button class="read-more-btn">Read More <i class="bi bi-chevron-down"></i></button>
         </div>
         <div class="category-type mb-3 para-wrap">
            <div class="category">Department: <strong>{{$jobCategory}}</strong></div>
            <div class="type">
               Type: <strong>{{$job->type}}</strong>
            </div>
         </div>
         <div class="date">
            <i class="bi bi-calendar"></i> : <strong>{{ \App\Helper::formatTimestampToDateString($job->date) }}</strong>
         </div>
      </div>
   </div>
</section>
<section id="job-form-form">
   <div class="main-container">
      <div class="heading text-center mb-4">Candidate Application Form</div>
      <div class="form-content-container">
         <div class="progression-bar">
            <div class="steps-click">
               <p>Personal Details</p>
               <div class="step-count step-count-0 active">
                  1
               </div>
            </div>
            <div class="steps-click">
               <p>Professional Details</p>
               <div class="step-count step-count-1">
                  2
               </div>
            </div>
            <div class="steps-click">
               <p>Educational Qualification</p>
               <div class="step-count step-count-2">
                  3
               </div>
            </div>
         </div>
         <form action="{{ route('jobs.jobDetail.form', $job->slug) }}" id="multiStepForm" class="form-container" enctype="multipart/form-data">
            @csrf
            <div class="form-step active personal-detail-form" id="form-step-1">
               <div class="row g-4">
                  <div class="mb-3 col-lg-4">
                     <label for="name">Name*</label>
                     <input type="text" name="name" class="form-control" placeholder="Enter Your First Name" required>
                  </div>
                  <div class="mb-3 col-lg-4">
                     <label for="email">Email Address*</label>
                     <input type="email" name="email" class="form-control" placeholder="Enter Your E-mail" required>
                  </div>
                  <div class="mb-3 col-lg-4">
                     <label for="contactNumber">Contact Number*</label>
                     <input type="text" name="contactNumber" class="form-control" maxlength="10"
                        onkeypress="return event.charCode >= 48 &amp;&amp; event.charCode <= 57"
                        placeholder="Enter Your Contact Number" required>
                  </div>
                  <div class="mb-3 col-lg-4">
                     <label for="dob">Date of Birth*</label>
                     <input id="dob" type="date" name="dob" class="form-control" placeholder="Enter Your Date of Birth"
                        required>
                  </div>
                  <div class="mb-3 col-lg-4">
                     <label for="gender">Gender*</label>
                     <select name="gender" class="form-control" required>
                        <option value="" disabled selected>Select Gender </option>
                        <option value="male">Male</option>
                        <option value="female">Female</option>
                        <option value="prefer_not_to_say">Prefer not to say</option>
                     </select>
                  </div>
                  <div class="mb-3 col-lg-4">
                     <label>Fresher/Experience*</label>
                     <div>
                        <label class="radio-label">
                           <input type="radio" name="exp" value="0" required> Fresher
                        </label>
                        <label class="radio-label">
                           <input type="radio" name="exp" value="1"> Experience
                        </label>
                     </div>
                  </div>

               </div>

               <button type="button" class="next">Next</button>
            </div>

            <div class="form-step professional-detail-form" id="form-step-2">
               <div class="row g-4">
                  <div class="mb-3 col-lg-4">
                     <label for="orgName">Present/Last Organization Name*</label>
                     <input type="text" name="orgName" class="form-control"
                        placeholder="E.g. Itahari Medical Hall, Hamro Hospital" required>
                  </div>
                  <div class="mb-3 col-lg-4">
                     <label for="currentCost">Current Annual CTC (LPA)*</label>
                     <input type="text" name="currentCost" class="form-control" placeholder="E.g. 5,00,000" required>
                  </div>
                  <div class="mb-3 col-lg-4">
                     <label for="expectedCost">Expected Annual CTC (LPA)*</label>
                     <input type="text" name="expectedCost" class="form-control" placeholder="E.g. 7,00,000" required>
                  </div>

                  <div class="mb-3 col-lg-4">
                     <label for="noticePeriod">Notice Period (In Days)*</label>
                     <input type="number" name="noticePeriod" class="form-control"
                        placeholder="Enter Your Notice Period" required>
                  </div>
                  <div class="mb-3 col-lg-4">
                     <label for="currentDesignation">Current Designation*</label>
                     <input type="text" name="currentDesignation" class="form-control"
                        placeholder="E.g. Associate, Senior Associate" required>
                  </div>
                  <div class="mb-3 col-lg-4">
                     <label for="department">Department*</label>
                     <input type="name" name="department" class="form-control" placeholder="E.g. Doctor, Nurse"
                        required>
                  </div>

                  <div class="mb-3 col-lg-4">
                     <label for="yearExp">Total Years of Experience*</label>
                     <input type="number" name="yearExp" class="form-control" placeholder="Enter Your Experience"
                        required>
                  </div>
                  <div class="mb-3 col-lg-4">
                     <label for="changeReason">Reason of Change</label>
                     <input type="name" name="changeReason" class="form-control" placeholder="Reason of Change">
                  </div>
               </div>
               <button type="button" class="prev me-3">Previous</button>
               <button type="button" class="next">Next</button>

            </div>

            <div class="form-step education-qualification" id="form-step-3">
               <div class="row g-4">
                  <div class="mb-3 col-lg-4">
                     <label for="institution">Institution Name*</label>
                     <input type="text" name="institution" class="form-control"
                        placeholder="Enter Your Institution Name" required>
                  </div>
                  <div class="mb-3 col-lg-4">
                     <label for="degree">Degree*</label>
                     <input type="text" name="degree" class="form-control" placeholder="Enter Degree" required>
                  </div>

                  <div class="mb-3 col-lg-4">
                     <label for="completionYear">Year of Completion*</label>
                     <input type="number" name="completionYear" class="form-control"
                        placeholder="Enter Year of Completion" required>
                  </div>
                  <div class="mb-3 col-lg-4">
                     <label for="securedPercent">Percentage Secured or CGPA*</label>
                     <input type="text" name="securedPercent" class="form-control" placeholder="Enter Percent">
                  </div>

                  <div class="mb-3 col-md-6">
                     <label for="resume">Resume (accepts only pdf) *</label>
                     <input class="file-input" type="file" accept=".pdf" name="resume" class="form-control"
                        required>
                  </div>
                  <div class=" mb-3 col-12">
                     <label for="jobMessage">Message to the Hiring Manager</label>
                     <textarea name="jobMessage" class="form-control"></textarea>
                  </div>
               </div>
               <button type="button" class="prev me-3">Previous</button>
               <button id="formSubmit" type="submit" class="submit">Submit</button>
            </div>
         </form>
      </div>
   </div>
</section>