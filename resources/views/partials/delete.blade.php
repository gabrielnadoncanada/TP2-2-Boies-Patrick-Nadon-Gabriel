@auth
<form class="delete" action="{{ url('images/'.$image->id) }}" method="POST">
    {{ csrf_field() }}
    {{ method_field('DELETE') }}

    <button type="submit" class="btn btn-danger my-3" data-toggle="tooltip" title="@lang('Supprimer cette image')">
    <i class="fas fa-trash fa-lg"></i>
    </button>
</form>
@endauth