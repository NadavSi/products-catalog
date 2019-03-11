<script type="text/javascript">
    var obj = <?php echo json_encode($this->data) ?>;
</script>
<div class="titleBar">
    <h2>My Products Catalog</h2>
</div>
<div class="container">
    <form method="GET"> 
        <div class="row">
            <label>search by:</label>
            <div class="col-lg-10 col-md-10 col-sm-12 col-xs-12 mt-xs">
                <label class="checkbox-inline"><input type="checkbox" name="cri[]" value="name" checked> keyword</label>&nbsp;
                <label class="checkbox-inline"><input type="checkbox" name="cri[]" value="color"> color</label>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-9 col-md-8 col-sm-12 col-xs-12 mt-xs">
                <div class="form-group">
                    <input class="form-control" type="text" maxlength="150" id="searchString" name="searchString" value="" placeholder="search...">
                </div> 
            </div>
            <div align=right class="col-lg-3 col-md-4 col-sm-12 col-xs-12 mt-xs">
                <button id="search" dir="rtl" type="submit" class="mb-xs mt-xs mr-xs btn btn-md btn-primary"><i class="fa fa-search"></i> search</button>
                <button id="reset" dir="rtl" type="button" class="mb-xs mt-xs mr-xs btn btn-md btn-success"><i class="fa fa-refresh"></i> reset</button>
            </div>
        </div>
    </form>
    <hr/>
    <div>
        <table id="products" class="display" style="width:100%">
            <thead>
                <tr>
                    <td align=center><nobr>Item Number</nobr></td>
                    <td align=center><nobr>Item Description</nobr></td>
                    <td align=center><nobr>Item Color</nobr></td>
                </tr>   
            </thead>
        </table>
    </div>
</div>