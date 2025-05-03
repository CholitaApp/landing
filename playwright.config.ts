import { defineConfig, devices } from '@playwright/test';

import dotenv from 'dotenv';

dotenv.config();

export default defineConfig({
    testDir: './tests/Playwright/E2E',
    fullyParallel: false,
    workers: 1,
    use: {
        headless: true,
        baseURL: process.env.APP_URL ?? 'http://127.0.0.1:8000',
        trace: 'retain-on-failure',
        ignoreHTTPSErrors: true,
        screenshot: 'only-on-failure',
    },

    projects: [
        { name: 'chromium', use: { ...devices['Desktop Chrome'] } },
    ],

    webServer: {
        command: 'php artisan serve & php artisan queue:work',
        url: process.env.APP_URL ?? 'http://127.0.0.1:8000',
    },
});
