


    <div class="form-group row mb-5">
            <label for="name" class="col-3">Nom de la techno</label>
            <input type="text" name="name" id="name" class="col-9" value="<?php echo isset($techno) ? $techno->name : ''; ?>">
        </div>

        <div class="form-group row mb-5">
            <label for="description" class="col-3">Description</label>
            <textarea class="form-control" id="description" name="description" rows="3">
                <?php echo isset($techno) ? $techno->description : ''; ?>
            </textarea>
        </div>

        <div id="menu-techno-form" class=" mb-5">
            <button type="submit" style="width: 100%;" class="btn btn-danger" name="submit">Enregistrer</button>
        </div>
    </form>

    