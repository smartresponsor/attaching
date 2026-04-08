# Attaching

Symfony-oriented attaching component for Smart Responsor.

## Current bootstrap scope
- DTO-first attachment baseline
- Entity inward-only persistence layer
- mirrored `Service/` and `ServiceInterface/`
- local storage driver baseline
- Symfony Fixtures + Faker planned in baseline dependencies
- QA scaffolding: PHP CS Fixer, PHPStan, PHPUnit

## Package identity
- Composer package: `smartresponsor/attaching`
- Component identity: **Attaching**
- Business object vocabulary: **attachment**

## Runtime baseline
- PHP `^8.4`
- Symfony `^8.0`
- Doctrine ORM `^3.3`

## Quality gates
- `composer phpstan -- --no-progress`
- `composer test -- --no-coverage`
- `composer cs:check -- --using-cache=no`

## Release surface
- Changelog: `CHANGELOG.md`
- Release process: `docs/release/release-process.adoc`

## Documentation surface
- Antora producer descriptor: `docs/antora.yml`
- Narrative pages: `docs/modules/ROOT/pages/`
- GitHub-facing landing remains in `README.md`
