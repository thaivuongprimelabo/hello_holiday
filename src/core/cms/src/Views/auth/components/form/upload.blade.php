<div class="form-group" id="{{ $name }}" style="border-bottom: 1px solid #dedede; padding-bottom:12px;">
    <label for="exampleInputEmail1"><button type="button" class="btn btn-primary mb-2 upload-btn"><i class="fa fa-upload"></i> Chọn {{ mb_strtolower($label) }}</button></label>
    <br/>
    <img src="{{ $image }}" class="img-thumbnail preview" style="{{ isset($style) ? $style : '' }}" />
    <br/>
    @error('upload_file.' . $name)<span class="text-danger">{{ $message }}</span>@enderror
</div>