<html>
  <body>
    <form method="post" action="/todo/hello">
      <input type="hidden" name="csrf_token" value="<?= csrf_token() ?>" />
      <div>
        <label>Name:</label>
        <input type="text" name="name" value="<?= $name ?>" />
      </div>
      <div>
        <input type="submit" value="Send" />
      </div>
    </form>
  </body>
</html>
