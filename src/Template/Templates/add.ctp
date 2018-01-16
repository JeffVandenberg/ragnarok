<?php

use App\Model\Entity\Template;
use App\View\AppView;

/* @var AppView $this */
/* @var Template $template */
$this->set('title_for_layout', 'Add Template');
?>

<div class="templates form">
    <?php echo $this->Form->create($template); ?>
    <h3><?php echo __('Add Template'); ?></h3>
    <?php
    echo $this->Form->control('template_name');
    echo $this->Form->control('description', array('style' => 'width: 100%', 'rows' => '10'));
    echo $this->Form->control('is_official');
    echo $this->Form->control('is_approved'); ?>
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
                            obj.label = obj.power_name;
                            obj.value = obj.power_id;
                        }
                        return ui.content;
                    },
                    select: function (e, ui) {
                        var row = $(this).closest('tr');
                        row.find('.power-id').val(ui.item.id);
                        row.find('.power-name').val(ui.item.power_name);
                        row.find('.power-cost').val(ui.item.cost);
                        e.preventDefault();
                    },
                    focus: function (e) {
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
                    if(templatePowerId === '') {
                        // remove row
                        $(this).closest('tr').remove();
                    }
                    else {
                        var powerName = $(this).closest('tr').find('.power-name').val();
                        if(confirm("Are you sure you want to remove " + powerName + "?")) {
                            var row = $(this);
                            var data = [];
                            data.push({name: 'template[template_power][id]', value: templatePowerId});
                            $.post(
                                baseUrl + 'templates/deletePower',
                                data,
                                function(response) {
                                    if(response.result === 'ok') {
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
                            .attr('name', 'template_powers[' + nextRow + '][id]')
                            .attr('id', 'template-powers-' + nextRow + '-id')
                            .attr('type', 'hidden')
                            .addClass('template-power-id')
                    )
                    .append(
                        $("<input />")
                            .attr('name', 'template_powers[' + nextRow + '][template_id]')
                            .attr('id', 'template-powers-' + nextRow + '-template-id')
                            .attr('type', 'hidden')
                            .val(0)
                    )
                    .append(
                        $("<input />")
                            .attr('name', 'template_powers[' + nextRow + '][power_id]')
                            .attr('id', 'template-powers-' + nextRow + '-power-id')
                            .attr('type', 'hidden')
                            .addClass('power-id')
                    )
                    .append(
                        $("<div>")
                            .addClass('input')
                            .append(
                                $("<input />")
                                    .attr('name', 'template_powers[' + nextRow + '][power][power_name]')
                                    .attr('maxlength', 45)
                                    .attr('type', 'text')
                                    .attr('id', 'template-powers-' + nextRow + '-power-power-name')
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
                                    .attr('name', 'template_powers[' + nextRow + '][power_cost]')
                                    .attr('type', 'text')
                                    .attr('id', 'template-powers-' + nextRow + '-power-cost')
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
