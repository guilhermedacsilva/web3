<?php if ($this->temErro($campo)): ?>
    <span class="help-block"><?= $this->getErro($campo) ?></span>
<?php endif ?>