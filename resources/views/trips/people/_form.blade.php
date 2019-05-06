<div class="field">
    <label class="label" for="first_name">{{ __('First name') }} (required)</label>
    <p class="control">
        <input type="text" class="input" name="first_name" id="first_name" value="{{ old('first_name', $person->first_name) }}">
    </p>
</div>
<div class="field">
    <label class="label" for="last_name">{{ __('Last name') }} (required)</label>
    <p class="control">
        <input type="text" class="input" name="last_name" id="last_name" value="{{ old('last_name', $person->last_name) }}">
    </p>
</div>
<div class="field">
    <label class="label" for="last_name">{{ __('Email') }}</label>
    <p class="control">
        <input type="text" class="input" name="email" id="email" value="{{ old('email', $person->email) }}">
    </p>
</div>

<div class="field">
    <label class="label" for="telephone">{{ __('Telephone') }}</label>
    <p class="control">
        <input type="text" class="input" name="telephone" id="telephone" value="{{ old('telephone', $person->telephone) }}">
    </p>
</div>

<div class="field">
    <label class="label" for="title">{{ __('Title') }}</label>
    <p class="control">
        <input type="text" class="input" name="title" id="title" value="{{ old('title', $person->title) }}">
    </p>
</div>

<div class="field">
    <label class="label" for="body">Biography</label>
    <p class="control">
        <markdown-textarea name="body" id="body" contents="{{ old('body', $person->body) }}"></markdown-textarea>
    </p>
</div>

<div class="field">
    <p class="control">
        <label class="checkbox">
            {{ Form::checkbox('is_participant', 1, $person->is_participant) }}
            Check the box if the person is a participant
        </label>
    </p>
</div>

<div class="field">
    <!--<p class="control">
        <label class="label">
            Category 
            {{ Form::select('category', array('Speaker' => 'Speaker', 'Facilitator' => 'Facilitator', 'CSPS Staff' => 'CSPS Staff'), $person->category, array('class' => 'dropdown-content', 'placeholder' => 'Please select ...') ) }}
        </label>
     </p>-->
      <label class="label">Category</label>
        <p class="control">
            <span class="select">
                <select name="category">
                    <option value="">Select a category</option>
                    <option value="Speaker" {{ old('category', $person->category) == 'Speaker'? 'selected' : ''}}>Speaker</option>
                    <option value="Distinguished Fellow" {{ old('category', $person->category) == 'Facilitator'? 'selected' : ''}}>Distinguished Fellow</option>
                    <option value="School Staff" {{ old('category', $person->category) == 'School Staff'? 'selected' : ''}}>School Staff</option>
                </select>
            </span>
        </p> 
</div> 

