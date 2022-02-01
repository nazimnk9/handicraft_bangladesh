<div class="navbar-nav">
	<form class="form-inline" method="post" id="searchStatus" action="{{route('find.search')}}">
		@csrf
		<div class="input-group">
			<input type="text" name="search" placeholder="Search" autocomplete="off">
			<div class="input-group-append">
				<button type="submit" value="submit" class="btn btn-secondary">Search</button>
			</div>
		</div>
	</form>
</div>