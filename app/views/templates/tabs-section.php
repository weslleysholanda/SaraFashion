<section class="tabs-section">
    <div class="site">
        <div class="tabs">
            <div class="tab active" onclick="showTabContent(event, 'description')">DESCRIÇÃO</div>
            <div class="tab" onclick="showTabContent(event, 'additional-info')">INFORMAÇÃO</div>
        </div>
        <div class="tabs-show">
            <div id="description" class="tab-content active">
                <div class="description-info">
                    <p><?php echo ($detalhe['descricao_produto']) ?></p>
                </div>
            </div>

            <div id="additional-info" class="tab-content">
                <h2>Indicação de Uso</h2>
                <p> <?php echo ($detalhe ['informacao_produto'])?></p>
            </div>
        </div>
    </div>
</section>