<!-- deepseek  -->

<!-- resources/views/components/progress-bar.blade.php -->
<div class="progress mb-4" style="height: 30px;">
    <div class="progress-bar progress-bar-striped bg-success" 
         role="progressbar" 
         style="width: {{ $progress }}%"
         aria-valuenow="{{ $progress }}" 
         aria-valuemin="0" 
         aria-valuemax="100">
        {{ $progress }}% Complete
    </div>
</div>