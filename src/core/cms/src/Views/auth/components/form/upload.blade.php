<div class="form-group" id="{{ $name }}" max-upload="{{ (\Cms\Constants::$maxUpload[$name] * 1024) }}" style="border-bottom: 1px solid #dedede; padding-bottom:12px;">
    <label for="exampleInputEmail1">
        <button type="button" class="btn btn-primary mb-2 upload-btn"><i class="fa fa-upload"></i> Chọn {{ mb_strtolower($label) }}</button>
        <span style="font-weight:initial">(Tối đa: {{ \Cms\Constants::$maxUploadText[$name] }}. Định dạng: *.jpg, *.png, *.jpeg)</span>
    </label>
    <br/>
    <img src="{{ $image }}" class="img-thumbnail preview" style="{{ isset($style) ? $style : '' }}" />
    <br/>
    @error('upload_file.' . $name)<span class="text-danger">{{ $message }}</span>@enderror
</div>