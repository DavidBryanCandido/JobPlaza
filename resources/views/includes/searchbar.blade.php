<div class="searchBG">
    <form class="searchinput" action="{{ route('jobs.index') }}" method="GET">
        <div class="inputcon1">
            <p><label for="what">What</label></p>
            <input class="input1" type="text" name="query" placeholder="Job title, keywords, or company" value="{{ request('query') }}" />
        </div>
        <div class="inputcon2">
            <p><label for="what">Where</label></p>
            <input class="input2" type="text" name="location" placeholder="City, Province" value="{{ request('location') }}" />
        </div>
        <button class="button button1" type="submit">Find Job</button>
    </form>
</div>
