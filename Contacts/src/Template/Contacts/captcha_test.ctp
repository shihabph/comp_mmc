<html>

<head>
      <title>reCAPTCHA demo: Simple page</title>
      <script src="https://www.google.com/recaptcha/api.js" async defer></script>
</head>
<?php
$this->Form->unlockField('g-recaptcha-response');
$this->Form->unlockField('name');
$this->Form->unlockField('phone');
?>

<body>

      <?= $this->Form->create(null, ['onsubmit' => 'return submitUserForm();']) ?>
      <div class="mb-3">
            <label class="form-label">Name</label>
            <input type="text" class="form-control" name="name" required>
      </div>
      <div class="mb-3">
            <label class="form-label">Phone</label>
            <input type="tel" class="form-control" name="phone">
      </div>
      <div class="g-recaptcha" data-sitekey="6Lch094lAAAAAOFcZrillsOpGBpQ9D_ptXWqTOxY"></div>
      <button type="submit" class="btn btn-info"><?= __d('setup', 'Submit') ?></button>
      <?= $this->Form->end() ?>

</body>

</html>

<script>
      // Get all the required fields
      const requiredFields = document.querySelectorAll('input[required]');

      // Add a red asterisk before each required field's label
      requiredFields.forEach(field => {
            const label = field.previousElementSibling;
            if (label) {
                  const asterisk = document.createElement('span');
                  asterisk.className = 'required';
                  asterisk.innerHTML = '* ';
                  asterisk.style.color = 'red';
                  asterisk.style.marginRight = '2px';
                  label.insertBefore(asterisk, label.firstChild);
            }
      });
</script>