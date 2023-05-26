<h1>{{ $job->title }}</h1>
<p>Company: {{  $job->employer ? $job->employer->company_name : 'Unknown Employer' }}</p>
<p>Location: {{ $job->location }}</p>
<p>Salary: {{ $job->salary }}</p>
<p>Job type: {{ $job->type }}</p>
<p>Descriptions: {{ $job->description }}</p>