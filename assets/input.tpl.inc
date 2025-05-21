<div class="col-6">
  <h1>Contact Form - Input</h1>
  <form class="input" method="post" action="./">
    <div class="mb-3">
      <label for="name" class="form-label">名前</label>
      <input type="text" class="form-control" id="name" name="name" value="<?php echo $tplVars['name']; ?>" />
    </div>

    <div class="mb-3">
      <label for="furigana" class="form-label">フリガナ</label>
      <input type="text" class="form-control" id="furigana" name="furigana" value="<?php echo $tplVars['furigana']; ?>" aria-describedby="furiganaHelp" />
      <div id="furiganaHelp" class="form-text">全角カタカナ、全角スペース、半角スペースが入力可能です。</div>
    </div>

    <div class="mb-3">
      <label for="email" class="form-label">メールアドレス</label>
      <input type="text" class="form-control" id="email" name="email" value="<?php echo $tplVars['email']; ?>" />
    </div>

    <div class="mb-3">
      <label for="category" class="form-label">お問い合わせ項目</label>
      <select class="form-control" id="category" name="category">
        <option>選択してください。</option>
        <?php foreach ($tplVars['categories'] as $id => $name): ?>
        <?php
          $isSelected = $id == $tplVars['category'] ? ' selected="selected"' : '';
          printf('<option value="%s"%s>%s</option>', $id, $isSelected, $name);
        ?>
        <?php endforeach; ?>
      </select>
    </div>

    <div class="mb-3">
      <label for="body" class="form-label">内容</label>
      <textarea class="form-control" id="body" name="body"><?php echo $tplVars['body']; ?></textarea>
    </div>

    <div class="buttons">
      <input type="hidden" name="rnd" value="<?php echo $tplVars['rnd']; ?>" />
      <button type="submit" class="btn btn-primary" name="cmd" value="confirm">Submit</button>
    </div>
  </form>
</div>

