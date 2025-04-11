from django.shortcuts import render, redirect
from django.http import JsonResponse
from .models import Report
from .forms import ReportForm

def submit_report(request):
    if request.method == 'POST':
        form = ReportForm(request.POST, request.FILES)
        if form.is_valid():
            report = form.save(commit=False)

            # Test Case 1.5: Flag false reports
            if not report.contact and len(report.description.strip()) < 10:
                report.flagged_for_review = True

            # Test Case 1.2 (optional backend check)
            nearby = Report.objects.filter(
                issue_type=report.issue_type,
                latitude__range=(report.latitude - 0.0005, report.latitude + 0.0005),
                longitude__range=(report.longitude - 0.0005, report.longitude + 0.0005)
            ).exists()

            if nearby:
                report.is_duplicate = True

            report.save()
            return render(request, 'submit.html', {'success': True, 'flagged': report.flagged_for_review})
    else:
        form = ReportForm()
    return render(request, 'submit.html', {'form': form})
    

def all_reports(request):
    data = list(Report.objects.values())
    return JsonResponse(data, safe=False)
