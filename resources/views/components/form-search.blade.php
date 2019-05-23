<form class="form-inline" method="POST" action="/searchResult">
        @csrf
        <input class="form-control" id="location" name="location" placeholder="Recherche par lieux" type="text" autocomplete="off">
        <button type="submit" class="form-control btn btn-primary"><i class="fas fa-search"></i></button>
    </form>
