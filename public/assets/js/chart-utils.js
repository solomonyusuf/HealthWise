/**
 * Chart Utility Functions for HealthWise Dashboard
 * Provides client-side validation and error handling for charts
 */

class ChartUtils {
    /**
     * Validate chart data before rendering
     */
    static validateChartData(data, type = 'general') {
        if (!data || typeof data !== 'object') {
            return { isValid: false, error: 'Invalid chart data provided' };
        }

        switch (type) {
            case 'radial':
                return this.validateRadialData(data);
            case 'line':
                return this.validateLineData(data);
            case 'bar':
                return this.validateBarData(data);
            case 'pie':
                return this.validatePieData(data);
            default:
                return this.validateGeneralData(data);
        }
    }

    /**
     * Validate radial chart data (diabetes risk chart)
     */
    static validateRadialData(data) {
        if (!Array.isArray(data.series) || data.series.length === 0) {
            return { isValid: false, error: 'Radial chart requires series data' };
        }

        const value = data.series[0];
        if (typeof value !== 'number' || value < 0 || value > 100) {
            return { isValid: false, error: 'Radial chart value must be between 0-100' };
        }

        return { isValid: true };
    }

    /**
     * Validate line chart data
     */
    static validateLineData(data) {
        if (!Array.isArray(data.labels) || !Array.isArray(data.data)) {
            return { isValid: false, error: 'Line chart requires labels and data arrays' };
        }

        if (data.labels.length !== data.data.length) {
            return { isValid: false, error: 'Line chart labels and data must have same length' };
        }

        if (data.data.some(val => typeof val !== 'number' || isNaN(val))) {
            return { isValid: false, error: 'Line chart data must contain valid numbers' };
        }

        return { isValid: true };
    }

    /**
     * Validate bar chart data
     */
    static validateBarData(data) {
        if (!Array.isArray(data.labels) || !Array.isArray(data.data)) {
            return { isValid: false, error: 'Bar chart requires labels and data arrays' };
        }

        if (data.labels.length !== data.data.length) {
            return { isValid: false, error: 'Bar chart labels and data must have same length' };
        }

        if (data.data.some(val => typeof val !== 'number' || isNaN(val) || val < 0)) {
            return { isValid: false, error: 'Bar chart data must contain positive numbers' };
        }

        return { isValid: true };
    }

    /**
     * Validate pie chart data
     */
    static validatePieData(data) {
        if (!Array.isArray(data.labels) || !Array.isArray(data.data)) {
            return { isValid: false, error: 'Pie chart requires labels and data arrays' };
        }

        if (data.labels.length !== data.data.length) {
            return { isValid: false, error: 'Pie chart labels and data must have same length' };
        }

        if (data.data.some(val => typeof val !== 'number' || isNaN(val) || val < 0)) {
            return { isValid: false, error: 'Pie chart data must contain non-negative numbers' };
        }

        return { isValid: true };
    }

    /**
     * Validate general chart data
     */
    static validateGeneralData(data) {
        if (!data.hasData) {
            return { isValid: true, isEmpty: true };
        }

        return { isValid: true };
    }

    /**
     * Handle chart rendering errors
     */
    static handleChartError(chartId, error) {
        console.error(`Chart error for ${chartId}:`, error);
        
        const container = document.querySelector(`#${chartId}`);
        if (container) {
            container.innerHTML = `
                <div class="d-flex flex-column align-items-center justify-content-center text-center" style="min-height: 200px;">
                    <i class="fas fa-exclamation-triangle text-warning mb-3" style="font-size: 2rem;"></i>
                    <p class="text-muted mb-2">Chart Error</p>
                    <small class="text-muted">${error.message || 'Unable to load chart data'}</small>
                </div>
            `;
        }
    }

    /**
     * Show loading state for charts
     */
    static showChartLoading(chartId) {
        const container = document.querySelector(`#${chartId}`);
        if (container) {
            container.innerHTML = `
                <div class="d-flex flex-column align-items-center justify-content-center" style="min-height: 200px;">
                    <div class="spinner-border text-primary mb-3" role="status">
                        <span class="visually-hidden">Loading...</span>
                    </div>
                    <p class="text-muted">Loading chart data...</p>
                </div>
            `;
        }
    }

    /**
     * Create empty state for charts with no data
     */
    static createEmptyState(chartId, message = 'No data available', icon = 'fa-chart-bar') {
        const container = document.querySelector(`#${chartId}`);
        if (container) {
            container.innerHTML = `
                <div class="d-flex flex-column align-items-center justify-content-center text-center" style="min-height: 200px;">
                    <i class="fas ${icon} text-muted mb-3" style="font-size: 2.5rem;"></i>
                    <p class="text-muted mb-2">${message}</p>
                    <small class="text-muted">Data will appear here once available</small>
                </div>
            `;
        }
    }

    /**
     * Safely render ApexCharts with error handling
     */
    static safeRenderChart(chartId, options) {
        try {
            // Check if ApexCharts is available
            if (typeof ApexCharts === 'undefined') {
                throw new Error('ApexCharts library not loaded');
            }

            // Validate options
            if (!options || typeof options !== 'object') {
                throw new Error('Invalid chart options');
            }

            // Check if container exists
            const container = document.querySelector(`#${chartId}`);
            if (!container) {
                throw new Error(`Chart container #${chartId} not found`);
            }

            // Create and render chart
            const chart = new ApexCharts(container, options);
            chart.render().catch(error => {
                this.handleChartError(chartId, error);
            });

            return chart;
        } catch (error) {
            this.handleChartError(chartId, error);
            return null;
        }
    }

    /**
     * Format health metrics for display
     */
    static formatHealthMetric(value, type = 'number') {
        if (value === null || value === undefined || isNaN(value)) {
            return 'N/A';
        }

        switch (type) {
            case 'percentage':
                return `${Math.round(value)}%`;
            case 'bmi':
                return parseFloat(value).toFixed(1);
            case 'heartrate':
                return `${Math.round(value)} BPM`;
            case 'decimal':
                return parseFloat(value).toFixed(2);
            default:
                return Math.round(value).toString();
        }
    }

    /**
     * Generate color palette for charts based on data state
     */
    static getChartColors(hasData = true, type = 'primary') {
        if (!hasData) {
            return {
                primary: '#CCCCCC',
                secondary: '#E0E0E0',
                background: 'rgba(200, 200, 200, 0.2)',
                border: 'rgba(150, 150, 150, 1)'
            };
        }

        const colorPalettes = {
            primary: {
                primary: '#3D7FF9',
                secondary: '#1E40AF',
                background: 'rgba(61, 127, 249, 0.2)',
                border: 'rgba(61, 127, 249, 1)'
            },
            success: {
                primary: '#10B981',
                secondary: '#059669',
                background: 'rgba(16, 185, 129, 0.2)',
                border: 'rgba(16, 185, 129, 1)'
            },
            warning: {
                primary: '#F59E0B',
                secondary: '#D97706',
                background: 'rgba(245, 158, 11, 0.2)',
                border: 'rgba(245, 158, 11, 1)'
            },
            danger: {
                primary: '#EF4444',
                secondary: '#DC2626',
                background: 'rgba(239, 68, 68, 0.2)',
                border: 'rgba(239, 68, 68, 1)'
            }
        };

        return colorPalettes[type] || colorPalettes.primary;
    }

    /**
     * Refresh chart data with error handling
     */
    static refreshChart(chartId, newData, chartInstance) {
        try {
            if (!chartInstance) {
                console.warn(`No chart instance found for ${chartId}`);
                return false;
            }

            // Validate new data
            const validation = this.validateChartData(newData);
            if (!validation.isValid) {
                throw new Error(validation.error);
            }

            // Update chart
            if (newData.series) {
                chartInstance.updateSeries(newData.series);
            }
            
            if (newData.labels) {
                chartInstance.updateOptions({
                    xaxis: {
                        categories: newData.labels
                    }
                });
            }

            return true;
        } catch (error) {
            console.error(`Error refreshing chart ${chartId}:`, error);
            this.handleChartError(chartId, error);
            return false;
        }
    }
}

// Make ChartUtils available globally
window.ChartUtils = ChartUtils;

// Add event listener for page load to initialize error handling
document.addEventListener('DOMContentLoaded', function() {
    // Handle chart container resize
    window.addEventListener('resize', function() {
        // Debounce resize handling
        clearTimeout(window.chartResizeTimer);
        window.chartResizeTimer = setTimeout(function() {
            // Trigger chart resize if ApexCharts is available
            if (typeof ApexCharts !== 'undefined' && ApexCharts.exec) {
                ApexCharts.exec('*', 'windowResize');
            }
        }, 250);
    });
});