# Laravel Training Scaffold — Student Instructions

This is the starter codebase for the Kalvium 12-Day Laravel Training program.

## What this repo is

This codebase is **intentionally incomplete**. Routes are stubs that throw 501 errors. Models have no relationships. Views are placeholders. Migrations have empty schemas.

Across 12 days, you'll fill in TODO comments aligned with each day's learning topic. By Day 12, this becomes a fully working Task & Project Management System.

## 🚀 Live Deployment

**Deployed on Render:** https://laravel-training-scaffold-fy1t.onrender.com

## ⚠️ A note on academic honesty

This scaffold was adapted from an existing open-source Laravel project (see Credits at the bottom).
That original repo has a complete, working implementation. **You can find it. Don't.**

Here's why looking at it defeats the entire purpose of this program:

- **The deliverable is not a working app.** The deliverable is YOU, ready to pass a recruiter's technical evaluation.
  A copied app cannot answer "why did you choose this approach?" or "live-code a new endpoint right now."
- **Mock Interview #1 (Day 6)** asks you to live-code an Eloquent relationship on the spot. You cannot fake this.
- **Mock Interview #2 (Day 10)** asks you to add a new endpoint under time pressure and explain your choices. You cannot fake this.
- **The technical evaluation with the actual recruiter** will be similar in format. If you can't pass our mocks, you won't pass theirs.

We trust you. Stuck for 2+ hours? Ask in the cohort channel before going hunting. That's what it's there for.

## Day 1 setup

```bash
# 1. Fork this repo to your own GitHub account, then clone YOUR fork:
git clone https://github.com/YOUR-USERNAME/laravel-training-scaffold.git laravel-training-yourname
cd laravel-training-yourname

# 2. Install dependencies
composer install

# 3. Create environment file
cp .env.example .env
php artisan key:generate

# 4. Create a local MySQL database, then update .env:
#    DB_DATABASE=laravel_training
#    DB_USERNAME=root
#    DB_PASSWORD=...

# 5. Migrate (don't run --seed yet — seeders are TODOs for Day 4!)
php artisan migrate

# 6. Run the app
php artisan serve
# Visit localhost:8000 — you should see the Laravel welcome page
```

If localhost:8000 loads, your Day 1 deliverable is done.

## How to find your daily TODOs

Each day has tagged TODOs throughout the codebase. To see your tasks for the day:

```bash
grep -rn "TODO Day 5"   # for Day 5
grep -rn "TODO Day 6"   # for Day 6
# etc.
```

You can also see ALL TODOs at once:

```bash
grep -rn "TODO Day" --include="*.php" --include="*.blade.php"
```

## Daily workflow

1. Open the spreadsheet — find today's row
2. Watch the day's primary video + read docs (≈2 hrs)
3. Run `grep -rn "TODO Day X"` to find your tasks
4. Implement each TODO (≈2 hrs); replace the `// TODO` comment with your code
5. Verify the app still runs: `php artisan serve` and click around
6. Write `docs/day-XX.md` reflection
7. Commit: `git commit -m "day-XX: <focus area>"`
8. Push to your fork

## Day-by-day cheat sheet

| Day | Focus | Files you'll touch |
|---|---|---|
| 1 | Setup | (none — just get it running) |
| 2 | Routes & controllers | routes/web.php, app/Http/Controllers/* |
| 3 | Blade views | resources/views/projects/*, tasks/* |
| 4 | Migrations + seeders | database/migrations/*, database/seeders/* |
| 5 | Eloquent CRUD | app/Models/*, app/Http/Controllers/* |
| 6 | Relationships ⭐ MI #1 | app/Models/* (relationships only) |
| 7 | Validation | app/Http/Requests/* |
| 8 | Auth (install Breeze) | install Breeze; app/Models/User.php |
| 9 | Authorization | app/Policies/*, app/Http/Middleware/CheckRole.php |
| 10 | REST API ⭐ MI #2 | install Sanctum; routes/api.php; app/Http/Resources/* |
| 11 | Files, mail, queues | app/Mail/TaskAssigned.php; storage handling |
| 12 | Tests + deploy | tests/Feature/*; deploy to Laravel Cloud |

## Rules

- **One repo, all 12 days.** Don't create new repos for each day.
- **Daily commits required.** Format: `git commit -m "day-XX: <focus area>"`
- **`docs/day-XX.md` is mandatory** — this is your interview prep material.
- **Don't push to the original scaffold** — you're working in YOUR fork.
- **Stuck >45 min?** Ask in the cohort channel before going deeper.

## Credits

This scaffold was adapted from [Task-management-app---Laravel-10 by UmerFarooq966](https://github.com/UmerFarooq966/Task-management-app---Laravel-10),
used here for educational purposes. Thanks to the original author.

Good luck.
