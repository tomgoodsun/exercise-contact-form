<div class="col-6">
  <h1>Contact Form - Input</h1>
  <form class="input" method="post">
    <div class="mb-3">
      <label for="name" class="form-label">名前</label>
      <input type="text" class="form-control" id="name" name="name" />
    </div>

    <div class="mb-3">
      <label for="furigana" class="form-label">フリガナ</label>
      <input type="text" class="form-control" id="furigana" name="furigana" aria-describedby="furiganaHelp" />
      <div id="furiganaHelp" class="form-text">全角カタカナ、全角スペース、半角スペースが入力可能です。</div>
    </div>

    <div class="mb-3">
      <label for="email" class="form-label">メールアドレス</label>
      <input type="text" class="form-control" id="email" name="email" />
    </div>
    
    <div class="mb-3">
      <label for="category" class="form-label">お問い合わせ項目</label>
      <select class="form-control" id="category" name="category">
        <option>選択してください。</option>
        <option value="1">仕事の依頼</option>
        <option value="2">求人について</option>
      </select>
    </div>

    <div class="mb-3">
      <label for="body" class="form-label">内容</label>
      <textarea class="form-control" id="body" name="body"></textarea>
    </div>

    <div class="buttons">
      <input type="hidden" name="rnd" value="" />
      <button type="submit" class="btn btn-primary" name="cmd" value="confirm">Submit</button>
    </div>
  </form>
</div>

