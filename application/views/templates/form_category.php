


    <div class="form-group row mb-5">
            <label for="type" class="col-3">Nom de la catégorie</label>
            <input type="text" name="type" id="type" class="col-9" value="<?php echo isset($category) ? $category->type : ''; ?>">
        </div>

        <div class="form-group row mb-5">
            <label for="description" class="col-3">Description</label>
            <textarea class="form-control" id="description" name="description" rows="3">
                <?php echo isset($category) ? $category->description : ''; ?>
            </textarea>
        </div>

        <div id="menu-categ-form" class=" mb-5">
            <button type="submit" class="btn btn-danger" name="submit">Enregistrer</button>
        </div>
    </form>

    