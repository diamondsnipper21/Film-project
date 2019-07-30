<footer class="site-footer">
  <div class="container">
        <div class="row">
            <div class="col-sm-4 site-links">
                <ul>
                    <li><a href="">About Us</a></li>
                    <li><a href="">Contact Us</a></li>
                    <li><a href="">FAQs</a></li>
                </ul>
            </div>

            <div class="col-sm-4 site-links">
                <ul>
                    @foreach(Cache::get('categories') as $item)
                        <li><a href="{{ route('home.category.show', $item->slug) }}">{{ $item->name }}</a></li>
                    @endforeach
                </ul>
            </div>

            <div class="col-sm-4">
              <nav class="social-links text-right" role="navigation">
                <a href="https://twitter.com/korfilm"><i class="fa fa-twitter fa-2x"></i></a>
                <a href="https://www.facebook.com/korfilm"><i class="fa fa-facebook fa-2x"></i></a>
                <a href="https://www.instagram.com/korfilm/"><i class="fa fa-instagram fa-2x"></i></a>
              </nav>
            </div>
        </div>
    </div>
</footer>