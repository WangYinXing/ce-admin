<div class="form-group"><label>Database infomation</label>
	<div><label>Added :</label><span>&nbsp;<?php if (!$param->isNew) { echo $param->added; } else { echo "---"; } ?></span></div>
	<div><label>Added by :</label><span>&nbsp;<?php if (!$param->isNew) { echo $param->addedby; } else { echo "---"; } ?></span></div>
	<div><label>Changed :</label><span>&nbsp;<?php if (!$param->isNew) { echo $param->changed; } else { echo "---"; } ?></span></div>
	<div><label>Changed by :</label><span>&nbsp;<?php if (!$param->isNew) { echo $param->changedby; } else { echo "---"; } ?></span></div>
</div>