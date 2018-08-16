
<div class="field">
    <label class="label" for="title">{{ __('Title') }}</label>
    <p class="control">
        <input type="text" class="input" name="name" id="name" value="{{ old('name', $link->name) }}">
    </p>
</div>

<div class="field">
    <label class="label" for="link_type">{{ __('Link type') }}</label>
    <p class="control">
        <input type="text" class="input" name="link_type" id="link_type" value="{{ old('link_type', $link->link_type) }}">
    </p>
</div>

<div class="field">
    <label class="label" for="linkinfo">Body</label>
    <p class="control">
        <markdown-textarea name="linkinfo" id="linkinfo" contents="{{ old('linkinfo', $link->linkinfo) }}"></markdown-textarea>
    </p>
</div>