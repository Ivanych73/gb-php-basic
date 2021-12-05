<div class="col">
    <div class="card shadow-sm">
        <a href = {detailViewHref}>
            <img class = gallery-img src = "{thumbnailPath}\{imgTitle}" alt = "">
        </a>

        <div class="card-body">
            <p class="card-text">{goodTitle}</p>
            <div class="d-flex justify-content-between align-items-center">
                <div class="btn-group">
                    <a class="btn btn-sm btn-outline-secondary" href = {detailViewHref}>{detailText}</a>
                    <a class="btn btn-sm btn-outline-secondary" href={buyOrDelHref}>{buyOrDelText}</a>
                </div>
                <small class="text-muted">Стоимость: {price}</small>
            </div>
        </div>
    </div>
</div>