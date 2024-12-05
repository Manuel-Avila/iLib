<div class="dark-overlay"></div>

<span class="flex-centered">
    <div class="confirm-modal">
        <img alt="Warning Icon" class="modal-icon" src="<?=BASE_PATH?>public/img/warning.png">
        <h1>¿Estas Seguro?</h1>
        <p><?=$modalMessage ?? ''?></p>
        <button class="button" id="accept-modal-button">Aceptar</button>
        <button class="button" id="cancel-button">Cancelar</button>
    </div>
</span>