Login :
<input id="search_name" name="search_name" size="7" value="<?php if(isset($this->criterias['search_name'])) echo $this->criterias['search_name']; ?>" style="margin-left:10px;" />
Sexe :
<select id="search_gender" name="search_gender" style="margin-left:10px;">
    <option value=""></option>
    <option value="2" <?php if($this->criterias['search_gender'] == 2) echo 'selected="selected" '; ?>>Femme</option>
    <option value="1" <?php if($this->criterias['search_gender'] == 1) echo 'selected="selected" '; ?>>Homme</option>
</select>
Age :
<select id="search_age" name="search_age" style="margin-left:10px;">
    <option value=""></option>
    <option value="20" <?php if($this->criterias['search_age'] == 20) echo 'selected="selected" '; ?>>< 20 ans</option>
    <option value="25" <?php if($this->criterias['search_age'] == 25) echo 'selected="selected" '; ?>>< 25 ans</option>
    <option value="30" <?php if($this->criterias['search_age'] == 30) echo 'selected="selected" '; ?>>< 30 ans</option>
    <option value="40" <?php if($this->criterias['search_age'] == 40) echo 'selected="selected" '; ?>>< 40 ans</option>
</select>
Distance :
<select id="search_distance" name="search_distance" style="margin-left:10px;">
    <option value="0"></option>
    <option value="20" <?php if($this->criterias['search_distance'] == 20) echo 'selected="selected" '; ?>>20 km</option>
    <option value="50" <?php if($this->criterias['search_distance'] == 50) echo 'selected="selected" '; ?>>50 km</option>
    <option value="100" <?php if($this->criterias['search_distance'] == 100) echo 'selected="selected" '; ?>>100 km</option>
    <option value="200" <?php if($this->criterias['search_distance'] == 200) echo 'selected="selected" '; ?>>200 km</option>
    <option value="300" <?php if($this->criterias['search_distance'] == 300) echo 'selected="selected" '; ?>>300 km</option>
</select>
