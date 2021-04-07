<?php $media = $this->getImages();  ?>
<?php $image = $this->getImage();  ?>

<div class="col-md-8 p-5 border border-dark position-absolute top-50 start-50 translate-middle">
    
<form method="POST" action="<?php echo $this->getUrl()->getUrl('update', 'Product\Media'); ?>" id="media"> 
    
    <button class="btn btn-primary" type="submit" name= "update">Update</button>    
    <button type="button" class="btn btn-danger" onclick="removeImage()" >Remove</button>
    <table class="table table-success table-striped ">
        <tr>
            <th scope="col">ImageId</th>
            <th scope="col">Image</th>
            <th scope="col">Label</th>
            <th scope="col">Small</th>
            <th scope="col">thumb</th>
            <th scope="col">base</th>
            <th scope="col">galery</th>
            <th scope="col">remove</th>
        </tr>
        <?php if(!$media): ?>
        <tr>
            <td colspan="8" style="text-align: center;">Record Not Found</td>
        </tr>
        <?php else: ?>
            <?php foreach ($media->getData() as $key => $value): ?>
                <tr>
                    <td><?php echo $value->imageId ?></td>
                    <td> 
                        <img src="Images/Product/<?php echo $value->image;  ?>" alt="Product Image" height="100px" width="100px">
                    </td>
                    <td>
                        <input type="text" name="image[data][<?php echo $value->imageId; ?>][label]" value="<?php echo $value->label ?>">
                    </td>
                    <td>
                        <input type="radio" name="image[small]" value="<?php echo $value->imageId ?>" <?php if($value->small) : ?> checked <?php endif; ?> >
                    </td>
                    <td>
                        <input type="radio" name="image[thumb]" value="<?php echo $value->imageId ?>" <?php if($value->thumb) : ?> checked <?php endif; ?>>
                    </td>
                    <td>
                        <input type="radio" name="image[base]" value="<?php echo $value->imageId ?>" <?php if($value->base) : ?> checked <?php endif; ?>>
                    </td>
                    <td>
                        <input type="checkbox" name="image[data][<?php echo $value->imageId ?>][gallary]" value="<?php echo $value->imageId ?>" <?php if($value->gallary) : ?> checked <?php endif; ?>>
                    </td>
                    <td> 
                        <input type="checkbox" name="image[remove][<?php echo $value->imageId ?>]" value="remove"> 
                    </td>
                </tr>
            <?php endforeach; ?>
        <?php endif; ?>

    </table>
</form>
<form method="POST" action="<?php echo $this->getUrl()->geturl('upload', 'Product\Media'); ?>" id="product-media-form" enctype="multipart/form-data">
    <input type="file" name="image" value="Upload Image"> <br><br>
    <input type="submit" value="Upload" disabled>
</form>
</div>

<script>
$(document).ready(
    function(){
        $('input:file').change(
            function(){
                if ($(this).val()) {
                    $('input:submit').attr('disabled',false);
                } 
            }
            );
    });
function removeImage() {
    var form = document.getElementById('media');
    form.setAttribute('Action', '<?php echo $this->getUrl()->getUrl('delete', 'Product\Media');?>');
    form.submit();
}
</script>