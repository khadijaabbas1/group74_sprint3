from django.shortcuts import render, redirect
from .forms import ReportForm

def submit_report(request):
    if request.method == 'POST':
        form = ReportForm(request.POST, request.FILES)
        if form.is_valid():
            form.save()
            return render(request, 'report_success.html')
    else:
        form = ReportForm()
    return render(request, 'submit_report.html', {'form': form})
