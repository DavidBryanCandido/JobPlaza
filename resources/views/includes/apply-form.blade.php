<form action="{{ route('job.apply', $job->id) }}" method="POST" enctype="multipart/form-data">

    @csrf
    <div class="form-group">
        <label for="name">Name</label>
        <input type="text" name="name" id="name" required>
    </div>

    <div class="form-group">
        <label for="email">Email</label>
        <input type="email" name="email" id="email" required>
    </div>

    <div class="form-group">
        <label for="resume">Resume</label>
        <input type="file" name="resume" id="resume" required>
    </div>

    <button type="submit">Submit</button>
</form>
