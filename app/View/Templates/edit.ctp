<?php /* @var View $this */ ?>
<?php $this->set('title_for_layout', __('Edit') . ': ' . $this->request->data['Template']['template_name']); ?>

    <div class="templates form">
        <?php echo $this->Form->create('Template'); ?>
        <h3><?php echo __('Edit Template'); ?></h3>
        <?php
        echo $this->Form->input('id');
        echo $this->Form->input('template_name');
        echo $this->Form->input('description', array('style' => 'width: 100%', 'rows' => '10'));
        echo $this->Form->input('is_official');
        echo $this->Form->input('is_approved'); ?>
        <div id="tabs">
            <ul>
                <li><a href="#powers">Powers</a></li>
            </ul>
            <div id="powers">
                <div class="paragraph">
                    <a href="#" id="add-power">Add Power <?php echo $this->Html->image('ragny_icon_add.png'); ?></a>
                </div>
                <table id="powers-table">
                    <tr>
                        <th>
                            Name
                        </th>
                        <th>
                            Cost
                        </th>
                        <th>

                        </th>
                    </tr>
                    <?php foreach ($this->request->data['TemplatePower'] as $row => $aTemplatepower): ?>
                        <tr>
                            <td>
                                <?php echo $this->Form->input("TemplatePower.$row.TemplatePower.id", array('class' => 'template-power-id')); ?>
                                <?php echo $this->Form->hidden("TemplatePower.$row.TemplatePower.template_id"); ?>
                                <?php echo $this->Form->hidden("TemplatePower.$row.TemplatePower.power_id", array('class' => 'power-id')); ?>
                                <?php echo $this->Form->input("TemplatePower.$row.Power.power_name", array('label' => false, 'class' => 'power-name')); ?>
                            </td>
                            <td>
                                <?php echo $this->Form->input("TemplatePower.$row.TemplatePower.power_cost", array('label' => false, 'class' => 'power-cost')); ?>
                            </td>
                            <td>
                                <div class="input">
                                    <?php echo $this->Html->image('ragny_icon_delete.png', array('title' => 'Delete Power', 'alt' => 'Delete Power', 'class' => array('delete-power', 'clickable'))); ?>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </table>
            </div>
        </div>
        <?php
        echo $this->Form->submit(__('Submit'), array('name' => 'action'));
        echo $this->Form->submit(__('Cancel'), array('name' => 'action', 'formnovalidate' => true));
        ?>
        <?php echo $this->Form->end(); ?>
    </div>
<?php $this->start('javascript'); ?>
    <script type="text/javascript">
        function UpdatePowerAutocomplete() {
            $(".power-name")
                .autocomplete({
                    source: baseUrl + 'powers/getList',
                    response: function (e, ui) {
                        for (var i = 0; i < ui.content.length; i++) {
                            var obj = ui.content[i];
                            obj.label = obj.Power.power_name;
                            obj.value = obj.Power.power_id;
                        }
                        return ui.content;
                    },
                    select: function (e, ui) {
                        var row = $(this).closest('tr');
                        row.find('.power-id').val(ui.item.Power.id);
                        row.find('.power-name').val(ui.item.Power.power_name);
                        row.find('.power-cost').val(ui.item.Power.cost);
                        e.preventDefault();
                    },
                    focus: function (e, ui) {
                        e.preventDefault();
                    },
                    search: function () {
                        $(this).closest('tr').find('.power-id').val('');
                        $(this).closest('tr').find('.power-cost').val('');
                    }
                });
        }

        $(function () {
            $("#tabs").tabs();

            $(document)
                .off('click', '.delete-power')
                .on('click', '.delete-power', function() {
                    var templatePowerId = $(this).closest('tr').find('.template-power-id').val();
                    if(templatePowerId == '') {
                        // remove row
                        $(this).closest('tr').remove();
                    }
                    else {
                        var powerName = $(this).closest('tr').find('.power-name').val();
                        if(confirm("Are you sure you want to remove " + powerName + "?")) {
                            var row = $(this);
                            var data = [];
                            data.push({name: 'data[TemplatePower][id]', value: templatePowerId});
                            $.post(
                                baseUrl + 'templates/deletePower',
                                data,
                                function(response) {
                                    if(response.result == 'ok') {
                                        $(row).closest('tr').remove();
                                    }
                                    else {
                                        alert(response.message);
                                    }
                                }
                            )
                        }
                    }
                });

            UpdatePowerAutocomplete();

            $("#add-power").click(function (e) {
                var row = $("<tr>");
                var cell1 = $("<td>");
                var cell2 = $("<td>");
                var cell3 = $("<td>");

                var nextRow = $(".power-id").length;
                cell1
                    .append(
                        $("<input />")
                            .attr('name', 'data[TemplatePower][' + nextRow + '][TemplatePower][id]')
                            .attr('id', 'TemplatePower' + nextRow + 'TemplatePowerId')
                            .attr('type', 'hidden')
                            .addClass('template-power-id')
                    )
                    .append(
                        $("<input />")
                            .attr('name', 'data[TemplatePower][' + nextRow + '][TemplatePower][template_id]')
                            .attr('id', 'TemplatePower' + nextRow + 'TemplatePowerTemplateId')
                            .attr('type', 'hidden')
                            .val($("#TemplateId").val())
                    )
                    .append(
                        $("<input />")
                            .attr('name', 'data[TemplatePower][' + nextRow + '][TemplatePower][power_id]')
                            .attr('id', 'TemplatePower' + nextRow + 'TemplatePowerPowerId')
                            .attr('type', 'hidden')
                            .addClass('power-id')
                    )
                    .append(
                        $("<div>")
                            .addClass('input')
                            .append(
                                $("<input />")
                                    .attr('name', 'data[TemplatePower][' + nextRow + '][Power][power_name]')
                                    .attr('maxlength', 45)
                                    .attr('type', 'text')
                                    .attr('id', 'TemplatePower' + nextRow + 'PowerPowerName')
                                    .attr('required', 'required')
                                    .addClass('power-name')
                            )
                    );

                cell2
                    .append(
                        $("<div>")
                            .addClass('input')
                            .append(
                                $("<input />")
                                    .attr('name', 'data[TemplatePower][' + nextRow + '][TemplatePower][power_cost]')
                                    .attr('type', 'text')
                                    .attr('id', 'TemplatePower' + nextRow + 'TemplatePowerPowerCost')
                                    .attr('required', 'required')
                                    .attr('type', 'number')
                                    .addClass('power-cost')
                            )
                    );

                cell3
                    .append(
                        $("<div>")
                            .addClass('input')
                            .append(
                                $("<img >")
                                    .attr('src', baseUrl + "img/ragny_icon_delete.png")
                                    .attr('title', 'Delete Power')
                                    .attr('alt', 'Delete Power')
                                    .addClass('delete-power')
                                    .addClass('clickable')
                            )
                    );

                $("#powers-table").append(
                    row
                        .append(cell1)
                        .append(cell2)
                        .append(cell3)
                );

                UpdatePowerAutocomplete();
                e.preventDefault();
            });
        })
        ;
    </script>
<?php $this->end(); ?>